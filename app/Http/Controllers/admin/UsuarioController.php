<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function all()
    {
        $data = User::all();
        return response()->json(['data' => $data]);
    }
    public function index()
    {
        //$usuarios = User::orderBy('id', 'desc');
        $pageTitle = 'Usuarios';
        return view('usuarios.index', compact('pageTitle'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:150',
            'password'   => 'required|string|max:150',
            'email'      => 'required|email|unique:users,email',
            'role'       => 'in:admin,manager,usuario',
            'cadastro'   => 'in:asociado,investidor,outro',
            'in_estatus' => 'in:ativo,inativo',
        ]);

        $validated['password'] = Hash::make($request->password);
        $usuario = User::create($validated);
        return response()->json([ 'data' => $usuario,'message' => 'Usuario Cadastrado correctamente'], 201);
    }

       public function edt($id)
    {
        $usuario = User::findOrFail($id);
         return response()->json(['data' => $usuario]);
    }

    public function update(Request $request, User $investidor)
    {
        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:150',
            'email' => 'sometimes|required|email|unique:investidores,email,' . $investidor->id,
            'telefone' => 'nullable|string|max:30',
            'documento' => 'nullable|string|max:20|unique:investidores,documento,' . $investidor->id,
            'saldo_inicial' => 'nullable|numeric|min:0',
            'observacoes' => 'nullable|string',
            'status' => 'in:ativo,inativo',
        ]);

        $investidor->update($validated);
        return response()->json($investidor);
    }

    public function del($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
