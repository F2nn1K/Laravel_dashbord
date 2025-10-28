<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Outro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class OutroController extends Controller
{
    public function all()
    {
        $data = Outro::all();
        return response()->json(['data' => $data]);
    }
    public function index()
    {
        $outros = Outro::orderBy('id', 'desc');
        $pageTitle = 'Outros';
        return view('outros.index', compact('outros','pageTitle'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'nome'              => 'required|string|max:150',
            'endereco'          => 'required|string|max:150',
            'telefone'          => 'nullable|string|max:30',
            'rampa'             => 'nullable|string|max:30',
            'aut_nome'          => 'nullable|string|max:30',
            'aut_telefone'      => 'nullable|string|max:30',
            'doc_identificacao' => 'nullable|string|max:30',
            'associado'         => 'nullable|string|max:30',
            'contrato'          => 'nullable|string|max:30',
            'in_estatus'         => 'in:ativo,inativo',
            //'documento'     => 'nullable|string|max:20|unique:Outros,documento',
           ]);

        $validated['user_id_add'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_del'] = Auth::id(); // More efficient than Auth::user()->id


        $outro = Outro::create($validated);
        return response()->json([ 'data' => $outro,'message' => 'Outro Cadastrado correctamente'], 201);
    }

   public function edt($id)
    {
        $Outro = Outro::findOrFail($id);
         return response()->json(['data' => $Outro]);
    }

    public function upd(Request $request, $id)
    {
        $Outro = Outro::findOrFail($id);
        $validated = $request->validate([
            'nome'              => 'required|string|max:150',
            'endereco'          => 'required|string|max:150',
            'telefone'          => 'nullable|string|max:30',
            'rampa'             => 'nullable|string|max:30',
            'aut_nome'          => 'nullable|string|max:30',
            'aut_telefone'      => 'nullable|string|max:30',
            'doc_identificacao' => 'nullable|string|max:30',
            'associado'         => 'nullable|string|max:30',
            'contrato'          => 'nullable|string|max:30',
            'in_estatus'        => 'in:ativo,inativo',
        ]);

        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id

        $Outro->update($validated);
        return response()->json([$Outro,'message' => 'Outro editado correctamente']);
    }

    public function del($id)
    {
        $empresa = Outro::findOrFail($id);
        $empresa->delete();
        return response()->json(['message' => 'Outro eliminado correctamente']);
    }
}