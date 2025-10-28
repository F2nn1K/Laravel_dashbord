<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaClaveGenerada;

class AuthController extends Controller
{
    public function showLoginForm()
{
    return view('auth.login');
}

public function showRegisterForm()
{
    return view('auth.register');
}

public function showForgotPasswordForm()
{
    return view('auth.forgot-password');
}

    // Registro de usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return response()->json(['message' => 'Registro exitoso', 'user' => $user]);
    }

    // Login de usuario
    public function logon(Request $request)
    {
        // Validar campos
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'name' => $request->name,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->regenerate();
            return response()->json(['message' => 'Login realizado com sucesso!', 'user' => $user]);
        }

        return response()->json(['message' => 'Usuário ou senha incorretos'], 401);
    }

    public function redireccionaRol()
    {
    $user = Auth::user();

    if (!$user) {
        return redirect('/login');
    }

        if ($user->hasRole('gerencia')) {
        return redirect('/gerencia/dashboard');
    }

    if ($user->hasRole('admin')) {
        return redirect('/admin/dashboard');
    }

    if ($user->hasRole('funcionario')) {
        return redirect('/funcionario/dashboard');
    }

    return redirect('/login'); // Ruta por defecto
    }

    // Olvidé mi contraseña (Forgot Password)
    public function forgotPassword(Request $request)
    {

       /*
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Correo de recuperación enviado']);
        }

        return response()->json(['message' => 'No se pudo enviar el correo'], 500);
        */
    }

        public function regenerarClave(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $usuario    = User::where('email', $request->email)->first();

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Generar nueva clave alfanumérica de 12 caracteres
        $nuevaClave = substr(str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789'), 0, 12);

        // Guardar la nueva clave hasheada
        $usuario->password = Hash::make($nuevaClave);
        $usuario->save();

        // Enviar correo con la nueva clave
        Mail::to($usuario->email)->send(new NuevaClaveGenerada($usuario, $nuevaClave));

        return response()->json(['message' => 'Nueva clave enviada al correo']);
    }

}
