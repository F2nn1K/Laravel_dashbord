<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    // Listar todas permissões
    public function index()
    {
        $pageTitle = 'Gerenciar Permissões';
        try {
            $permissions = DB::table('permissions')
                ->where('in_estatus', 'ativo')
                ->orderBy('module', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        } catch (\Throwable $e) {
            \Log::warning('Falha ao carregar permissões: ' . $e->getMessage());
            $permissions = collect();
        }

        return view('permissions.index', compact('pageTitle', 'permissions'));
    }

    // API: Todas permissões
    public function all()
    {
        $permissions = DB::table('permissions')
            ->where('in_estatus', 'ativo')
            ->orderBy('name', 'asc')
            ->get();
            
        return response()->json(['data' => $permissions]);
    }

    // Criar permissão
    public function add(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:100|unique:permissions,code',
            'description' => 'nullable|string',
            'module' => 'nullable|string|max:50',
        ]);

        $validated['user_id_add'] = Auth::id();
        $validated['user_id_upd'] = Auth::id();
        $validated['user_id_del'] = Auth::id();
        $validated['in_estatus'] = 'ativo';

        $id = DB::table('permissions')->insertGetId($validated);

        return response()->json([
            'message' => 'Permissão criada com sucesso',
            'id' => $id
        ], 201);
    }

    // Editar permissão
    public function edt($id)
    {
        $permission = DB::table('permissions')->where('id', $id)->first();
        
        if (!$permission) {
            return response()->json(['message' => 'Permissão não encontrada'], 404);
        }

        return response()->json(['data' => $permission]);
    }

    // Atualizar permissão
    public function upd(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:100|unique:permissions,code,' . $id,
            'description' => 'nullable|string',
            'module' => 'nullable|string|max:50',
            'in_estatus' => 'in:ativo,inativo',
        ]);

        $validated['user_id_upd'] = Auth::id();

        DB::table('permissions')->where('id', $id)->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Permissão atualizada com sucesso'
        ]);
    }

    // Deletar permissão
    public function del($id)
    {
        DB::table('permissions')->where('id', $id)->delete();
        
        return response()->json(['message' => 'Permissão deletada com sucesso']);
    }
}

