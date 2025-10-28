<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Investidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestidorController extends Controller
{
    public function all()
    {
        $data = Investidor::all();
        return response()->json(['data' => $data]);
        //return response()->json($investidores);
    }
    public function index()
    {
        $investidores = Investidor::orderBy('id', 'desc');
        $pageTitle = 'Investidores';
        return view('investidores.index', compact('investidores','pageTitle'));
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
           ]);

        $validated['user_id_add'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_del'] = Auth::id(); // More efficient than Auth::user()->id
        $investidor = Investidor::create($validated);
        return response()->json([ 'data' => $investidor,'message' => 'Investidor Cadastrado correctamente'], 201);
    }

       public function edt($id)
    {
        $asociado = Investidor::findOrFail($id);
         return response()->json(['data' => $asociado]);
    }

    public function upd(Request $request, $id)
    {
        $investidor = Investidor::findOrFail($id);
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

        $investidor->update($validated);
        return response()->json([$investidor,'message' => 'Investidor editado correctamente']);
    }

    public function del($id)
    {
        $investidor = Investidor::findOrFail($id);
        $investidor->delete();
        return response()->json(['message' => 'Investidor eliminado correctamente']);
    }
}
