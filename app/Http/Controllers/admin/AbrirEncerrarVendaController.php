<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\AbrirEncerrarVenda;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbrirEncerrarVendaController extends Controller
{
    protected $user;
    
    public function all()
    {
        $data = AbrirEncerrarVenda::all();
        return response()->json(['data' => $data]);
    }
    public function index()
    {
        $produtos = AbrirEncerrarVenda::orderBy('id', 'desc');
        $pageTitle = 'Abrir/Encerrar Vendas';
        return view('vendas.abrir', compact('produtos','pageTitle'));
    }

    public function add(Request $request)
    {
    $validated = $request->validate([
        'ca_disponivel' => 'required',
        'fe_abrir_vendas' => 'nullable|date',
        'hr_abrir_vendas' => 'nullable',
        'fe_encerrar_vendas' => 'nullable|date',
        'hr_encerrar_vendas' => 'nullable',
        'aut_associados' => 'nullable',
        'aut_investidores' => 'nullable',
        'aut_outros' => 'nullable',
        ]);

        $producto_id=1;
        $produto = Produto::find($producto_id);
     if ($produto) {
          $data_producto = $request->validate([
            //'preco_venda_brl'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_usd'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_gold'  => ['required', 'numeric', 'between:0,9999999999999.99'],
            //'preco_venda_euro'  => ['required', 'numeric', 'between:0,9999999999999.99'],
        ]);
          $produto->update($data_producto);
        } else {
                return response()->json([
                        'status' => false,
                        'message' => 'O produto não existe, recarregue a página.'
                    ]);
        }

    $validated['user_id_add'] = Auth::id(); // More efficient than Auth::user()->id
    $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
    $validated['user_id_del'] = Auth::id(); // More efficient than Auth::user()->id

    AbrirEncerrarVenda::create($validated);

        return response()->json(['message' => 'Abrir/Encerrar Cadastrada correctamente'], 201);
    }

    public function edt($id)
    {
        $data           = AbrirEncerrarVenda::findOrFail($id);
        $producto_id    = 1;
        $produto        = Produto::findOrFail($producto_id);
        return response()->json([
            'data'    => $data,
            'produto' => $produto
        ]);
    }

    public function upd(Request $request, $id)
    {
         $abrirEncerrarVenda = AbrirEncerrarVenda::findOrFail($id);

        $validated = $request->validate([
        'ca_disponivel' => 'required',
        'fe_abrir_vendas' => 'nullable|date',
        'hr_abrir_vendas' => 'nullable',
        'fe_encerrar_vendas' => 'nullable|date',
        'hr_encerrar_vendas' => 'nullable',
        'aut_associados' => 'nullable',
        'aut_investidores' => 'nullable',
        'aut_outros' => 'nullable',
        ]);

                $producto_id=1;
        $produto = Produto::find($producto_id);
     if ($produto) {
          $data_producto = $request->validate([
            //'preco_venda_brl'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_usd'   => ['required', 'numeric', 'between:0,9999999999999.99'],
            'preco_venda_gold'  => ['required', 'numeric', 'between:0,9999999999999.99'],
            //'preco_venda_euro'  => ['required', 'numeric', 'between:0,9999999999999.99'],
        ]);
          $produto->update($data_producto);
        } else {
                return response()->json([
                        'status' => false,
                        'message' => 'O produto não existe, recarregue a página.'
                    ]);
        }

        $validated['aut_associados'] = $request->has('aut_associados') ? "on" : "off";
        $validated['aut_investidores'] = $request->has('aut_investidores') ? "on" : "off";
        $validated['aut_outros'] = $request->has('aut_outros') ? "on" : "off";
        $validated['user_id_upd'] = Auth::id();

        $abrirEncerrarVenda->update($validated);
        return response()->json([$abrirEncerrarVenda,'message' => 'Abrir/Encerrar editado correctamente']);
    }

    public function del($id)
    {
        $empresa = AbrirEncerrarVenda::findOrFail($id);
        $empresa->delete();
        return response()->json(['message' => 'Abrir/Encerrar eliminada correctamente']);
    }
}
