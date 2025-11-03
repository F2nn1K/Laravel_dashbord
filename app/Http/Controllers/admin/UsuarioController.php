<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Empresa;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        $empresas = Empresa::where('in_estatus', 'ativo')->orderBy('nome')->get(['id','nome']);
        return view('usuarios.index', compact('pageTitle','empresas'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:150',
            'password'   => 'required|string|max:150',
            'email'      => 'required|email|unique:users,email',
            'role'       => 'in:admin,manager,user',
            'cadastro'   => 'in:asociado,investidor,outro',
            'in_estatus' => 'in:ativo,inativo',
            'empresa_id' => 'required|integer|exists:empresas,id',
        ]);

        $validated['password'] = Hash::make($request->password);
        $usuario = User::create($validated);

        // Vincular usuário à empresa como funcionário
        Funcionario::create([
            'user_id'      => $usuario->id,
            'empresa_id'   => (int) $request->empresa_id,
            'in_setor'     => 'vendas',
            'in_estatus'   => 'ativo',
            'user_id_add'  => Auth::id(),
            'user_id_upd'  => Auth::id(),
            'user_id_del'  => Auth::id(),
        ]);

        // VINCULAR AO PERFIL CORRESPONDENTE na tabela user_role
        if (isset($validated['role'])) {
            $roleId = \DB::table('roles')->where('code', $validated['role'])->value('id');
            if ($roleId) {
                \DB::table('user_role')->insert([
                    'user_id' => $usuario->id,
                    'role_id' => $roleId,
                    'created_at' => now(),
                ]);
            }
        }

        return response()->json([ 'data' => $usuario,'message' => 'Usuario Cadastrado correctamente'], 201);
    }

    public function edt($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json(['data' => $usuario]);
    }

    public function upd(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,manager,user',
            'in_estatus' => 'in:ativo,inativo',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Atualizar dados básicos
        $usuario->name = $validated['name'];
        $usuario->email = $validated['email'];
        $usuario->role = $validated['role'];
        
        if (isset($validated['in_estatus'])) {
            $usuario->in_estatus = $validated['in_estatus'];
        }

        // Atualizar senha apenas se foi fornecida
        if (!empty($validated['password'])) {
            $usuario->password = Hash::make($validated['password']);
        }

        $usuario->save();

        // SINCRONIZAR COM TABELA user_role
        // Remover perfis antigos
        \DB::table('user_role')->where('user_id', $id)->delete();
        
        // Buscar o perfil correspondente ao role
        $roleId = \DB::table('roles')->where('code', $validated['role'])->value('id');
        
        if ($roleId) {
            // Vincular ao novo perfil
            \DB::table('user_role')->insert([
                'user_id' => $id,
                'role_id' => $roleId,
                'created_at' => now(),
            ]);
        }

        // Limpar cache de permissões do usuário
        \App\Helpers\PermissionHelper::clearUserPermissionsCache($id);

        return response()->json([
            'status' => true,
            'message' => 'Usuário atualizado com sucesso'
        ]);
    }

    public function del($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}
