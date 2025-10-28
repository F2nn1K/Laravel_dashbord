<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Asociado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class AsociadoController extends Controller
{
    public function all()
    {
        $data = Asociado::all();
        return response()->json(['data' => $data]);
    }
    public function index()
    {
        $asociados = Asociado::orderBy('id', 'desc');
        $pageTitle = 'Asociados';
        return view('asociados.index', compact('asociados','pageTitle'));
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


        $investidor = Asociado::create($validated);
        return response()->json([ 'data' => $investidor,'message' => 'Asociado Cadastrado correctamente'], 201);
    }

   public function edt($id)
    {
        $asociado = Asociado::findOrFail($id);
         return response()->json(['data' => $asociado]);
    }

    public function upd(Request $request, $id)
    {
        $asociado = Asociado::findOrFail($id);
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

        $asociado->update($validated);
        return response()->json([$asociado,'message' => 'Asociado editado correctamente']);
    }

    public function del($id)
    {
        $asociado = Asociado::findOrFail($id);
        $asociado->delete();
        return response()->json(['message' => 'Asociado eliminado correctamente']);
    }
}