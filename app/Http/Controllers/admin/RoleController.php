<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    // Listar todos perfis
    public function index()
    {
        $pageTitle = 'Gerenciar Perfis';
        $roles = DB::table('roles')
            ->where('in_estatus', 'ativo')
            ->orderBy('name', 'asc')
            ->get();
            
        $permissions = DB::table('permissions')
            ->where('in_estatus', 'ativo')
            ->orderBy('module', 'asc')
            ->orderBy('name', 'asc')
            ->get()
            ->groupBy('module');
            
        return view('permissions.roles', compact('pageTitle', 'roles', 'permissions'));
    }

    // API: Todos perfis
    public function all()
    {
        $roles = DB::table('roles')
            ->where('in_estatus', 'ativo')
            ->orderBy('name', 'asc')
            ->get();
            
        return response()->json(['data' => $roles]);
    }

    // Obter perfil com permissões
    public function edt($id)
    {
        $role = DB::table('roles')->where('id', $id)->first();
        
        if (!$role) {
            return response()->json(['message' => 'Perfil não encontrado'], 404);
        }

        // Buscar permissões do perfil
        $permissionsIds = DB::table('role_permission')
            ->where('role_id', $id)
            ->pluck('permission_id')
            ->toArray();

        return response()->json([
            'data' => $role,
            'permissions' => $permissionsIds
        ]);
    }

    // Criar perfil
    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:100|unique:roles,code',
            'description' => 'nullable|string',
        ]);

        $validated['user_id_add'] = Auth::id();
        $validated['user_id_upd'] = Auth::id();
        $validated['user_id_del'] = Auth::id();
        $validated['in_estatus'] = 'ativo';

        $roleId = DB::table('roles')->insertGetId($validated);

        // Atribuir permissões
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            foreach ($permissions as $permissionId) {
                DB::table('role_permission')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        return response()->json([
            'message' => 'Perfil criado com sucesso',
            'id' => $roleId
        ], 201);
    }

    // Atualizar perfil e permissões
    public function upd(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:100|unique:roles,code,' . $id,
            'description' => 'nullable|string',
            'in_estatus' => 'in:ativo,inativo',
        ]);

        $validated['user_id_upd'] = Auth::id();

        DB::table('roles')->where('id', $id)->update($validated);

        // Atualizar permissões
        // Deletar permissões antigas SEMPRE
        DB::table('role_permission')->where('role_id', $id)->delete();
        
        // Inserir novas permissões (se tiver)
        if ($request->has('permissions')) {
            $permissions = $request->input('permissions');
            foreach ($permissions as $permissionId) {
                DB::table('role_permission')->insert([
                    'role_id' => $id,
                    'permission_id' => $permissionId,
                ]);
            }
        }

        // Limpar cache de permissões de todos os usuários com este perfil
        $usersWithRole = DB::table('user_role')->where('role_id', $id)->pluck('user_id');
        foreach ($usersWithRole as $userId) {
            \App\Helpers\PermissionHelper::clearUserPermissionsCache($userId);
        }

        // Limpar TODOS os caches para garantir
        \Cache::flush();
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');

        return response()->json([
            'status' => true,
            'message' => 'Permissões atualizadas com sucesso!'
        ]);
    }

    // Deletar perfil
    public function del($id)
    {
        DB::table('roles')->where('id', $id)->delete();
        
        return response()->json(['message' => 'Perfil deletado com sucesso']);
    }
}

