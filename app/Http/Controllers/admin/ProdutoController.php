<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    protected $user;
    
    public function all()
    {
        $data = Produto::all();
        return response()->json(['data' => $data]);
        //return response()->json($investidores);
    }
    public function index()
    {
        $produtos = Produto::orderBy('id', 'desc');
        $pageTitle = 'Produtos';
        return view('produtos.index', compact('produtos','pageTitle'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'codigo'            => 'required|string|max:150',
            'descricao'         => 'sometimes|required|string|max:150',
            'nome'              => 'required|string|max:150',
            'estoque_minimo'    => 'nullable|string|max:30',
            'custo'             => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_brl'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_usd'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_gold'  => ['required', 'numeric', 'between:0,9999999999999.99'],
            //'preco_venda_euro'  => ['required', 'numeric', 'between:0,9999999999999.99'],
            'in_estatus'        => 'in:ativo,inativo',
        ]);

        $validated['user_id_add'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_del'] = Auth::id(); // More efficient than Auth::user()->id

        $produto = Produto::create($validated);
        return response()->json([ 'data' => $produto,'message' => 'Produto Cadastrado correctamente'], 201);
    }

    public function edt($id)
    {
        $data = Produto::findOrFail($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function upd(Request $request, $id)
    {

        $validated = $request->validate([
            'codigo'            => 'required|string|max:150',
            'descricao'         => 'sometimes|required|string|max:150',
            'nome'              => 'required|string|max:150',
            'estoque_minimo'    => 'nullable|string|max:30',
            'custo'             => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_brl'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_usd'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_gold'  => ['required', 'numeric', 'between:0,9999999999999.99'],
            //'preco_venda_euro'  => ['required', 'numeric', 'between:0,9999999999999.99'],
            'in_estatus'        => 'in:ativo,inativo',
        ]);

        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'status' => false,
                'message' => 'O produto não existe, recarregue a página.'
            ]);
        }

        $produto->update($validated);
        return response()->json([$produto,'status' => true,
            'message' => 'Atualizado com sucesso',]);
    }

    public function del($id)
    {
        $empresa = Produto::findOrFail($id);
        $empresa->delete();
        return response()->json(['message' => 'Produto eliminado correctamente']);
    }
}
