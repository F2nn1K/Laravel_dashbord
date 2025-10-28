<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    protected $user;
    
    public function all()
    {
        $data = Venda::all();
        return response()->json(['data' => $data]);
    }
    public function index()
    {
        $produtos = Venda::orderBy('id', 'desc');
        $pageTitle = 'Vendas';
        return view('vendas.index', compact('produtos','pageTitle'));
    }

    public function add(Request $request)
    {
    $data = $request->validate([
        'nb_cliente' => 'nullable',
        'nb_produto' => 'nullable',
        'ca_produto' => 'required',
        'hr_encerrar_vendas' => 'nullable',
        'nu_rampa' => 'required',
        'mo_total' => 'required',
        'tp_pagamento' => 'required',
        'in_estatus' => 'in:ativo,inativo',
        ]);
    $fechaHora      = Carbon::parse(now())->format('Y-m-d H:i:s');
    $produto_id     = $request->input('nb_produto');
    $data_produto   = Produto::findOrFail($produto_id);

    // Consulta com Query Builder
    $registro = DB::table('abrir_encerrar_venda')
        ->selectRaw('id')
        ->whereRaw('? >= CONCAT(fe_abrir_vendas, " ", hr_abrir_vendas)', [$fechaHora])
        ->whereRaw('? <= CONCAT(fe_encerrar_vendas, " ", hr_encerrar_vendas)', [$fechaHora])
        ->orderBy('id', 'asc')
        ->limit(1)
        ->first();
        
    if ($registro) {
        $data['nb_produto'] = $data_produto->nome; 
        $data['user_id_add'] = Auth::id(); 
        $data['user_id_upd'] = Auth::id(); 
        $data['user_id_del'] = Auth::id();
        $data['aben_venda_id'] = $registro->id; 
        Venda::create($data);
        return response()->json(['message' => 'Venda Cadastrada correctamente '.$fechaHora], 201);
    } else {
        $id = null;
        return response()->json(['message' => 'Não há vendas disponíveis no momento. Entre em contato com um administrador. '.$fechaHora], 402);
    }


    }

    public function edt($id)
    {
        $data = Venda::findOrFail($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function upd(Request $request, $id)
    {
        $this->user = auth()->user();

        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:150',
            'descricao' => 'sometimes|required|string|max:150',
            //'email' => 'sometimes|required|email|unique:investidores,email,' . $investidor->id,
            'estoque_minimo' => 'nullable|numeric|min:0',
            //'custo' => 'nullable|string|max:20|unique:investidores,documento,' . $investidor->id,
            'custo' => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_brl' => ['required', 'decimal:2'],
            'preco_venda_usd' => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_gold' => ['required', 'numeric', 'between:0,9999999999999.99'],
            'in_estatus' => 'in:ativo,inativo',
        ]);

        $produto = Venda::find($id);

        if (!$produto) {
            return response()->json([
                'status' => false,
                'message' => 'O produto não existe, recarregue a página.'
            ]);
        }

        $produto->nome              = $request->input('nome');
        $produto->descricao         = $request->input('descricao');
        $produto->estoque_minimo    = $request->input('estoque_minimo');
        $produto->custo             = $request->input('custo');
        $produto->preco_venda_brl   = $request->input('preco_venda_brl');
        $produto->preco_venda_usd   = $request->input('preco_venda_usd');
        $produto->preco_venda_gold  = $request->input('preco_venda_gold');
        $produto->in_estatus        = $request->input('in_estatus');
                
        $produto->user_id_upd       = $this->user->id;
        $produto->save();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso',
        ]);
    }

    public function del($id)
    {
        $empresa = Venda::findOrFail($id);
        $empresa->delete();
        return response()->json(['message' => 'Investidor eliminado correctamente']);
    }
}
