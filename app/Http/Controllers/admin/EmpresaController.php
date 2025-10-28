<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
  
    public function all()
    {
        $data = Empresa::all();
        return response()->json(['data' => $data]);
    }
    public function index()
    {
        $registros = Empresa::orderBy('id', 'desc');
        $pageTitle = 'Empresas';
        return view('empresas.index', compact('registros','pageTitle'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'nome'              => 'required|string|max:150',
            'descricao'         => 'nullable|string|max:30',
            'responsavel'         => 'nullable|string|max:30',
            'email'             => 'required|email|unique:empresas,email',
            'telefone'          => 'nullable|string|max:30',
            'in_estatus'        => 'in:ativo,inativo',
        ]);

        $validated['user_id_add'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_del'] = Auth::id(); // More efficient than Auth::user()->id

        $empresa = Empresa::create($validated);
        return response()->json([ 'data' => $empresa,'message' => 'Empresa Cadastrada correctamente'], 201);
    }

    public function edt($id)
    {
        $data = Empresa::findOrFail($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function upd(Request $request, $id)
    {

        $validated = $request->validate([
            'nome'              => 'required|string|max:150',
            'descricao'         => 'nullable|string|max:30',
            'responsavel'         => 'nullable|string|max:30',
            'email'             => 'required|email|unique:empresas,email',
            'telefone'          => 'nullable|string|max:30',
            'in_estatus'        => 'in:ativo,inativo',
        ]);

        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        
        $empresa = Empresa::find($id);

        if (!$empresa) {
            return response()->json([
                'status' => false,
                'message' => 'O empresa não existe, recarregue a página.'
            ]);
        }

        $empresa->update($validated);
        return response()->json([$empresa,'status' => true,
            'message' => 'Atualizado com sucesso',]);
    }

    public function del($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return response()->json(['message' => 'Empresa eliminado correctamente']);
    }
}
