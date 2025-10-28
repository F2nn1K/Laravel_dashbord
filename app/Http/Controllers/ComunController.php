<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\Venda;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaClaveGenerada;
use App\Models\Produto;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ComunController extends Controller
{
    public function dashboard()
    {
        $vendas          = Venda::orderBy('fe_add', 'desc')->take(10)->get();
        $mo_total_usd    = $vendas->where('tp_pagamento', 'usd')->sum('mo_total');
        $mo_total_gold   = $vendas->where('tp_pagamento', 'gold')->sum('mo_total');
        
        // Buscar cotação do Dólar (cache de 30 minutos)
        $cotacao_dolar = Cache::remember('cotacao_dolar', 1800, function () {
            try {
                $response = Http::timeout(5)->get('https://economia.awesomeapi.com.br/json/last/USD-BRL');
                if ($response->successful()) {
                    $data = $response->json();
                    return [
                        'valor' => number_format((float)$data['USDBRL']['bid'], 2, ',', '.'),
                        'variacao' => (float)$data['USDBRL']['pctChange'],
                        'atualizacao' => date('H:i', strtotime($data['USDBRL']['create_date']))
                    ];
                }
            } catch (\Exception $e) {
                // Em caso de erro, retorna valores padrão
            }
            return ['valor' => 'N/A', 'variacao' => 0, 'atualizacao' => '--:--'];
        });

        // Buscar cotação do Ouro (cache de 30 minutos)
        $cotacao_ouro = Cache::remember('cotacao_ouro', 1800, function () {
            try {
                $response = Http::timeout(5)->get('https://economia.awesomeapi.com.br/json/last/XAU-BRL');
                if ($response->successful()) {
                    $data = $response->json();
                    return [
                        'valor' => number_format((float)$data['XAUBRL']['bid'], 2, ',', '.'),
                        'variacao' => (float)$data['XAUBRL']['pctChange'],
                        'atualizacao' => date('H:i', strtotime($data['XAUBRL']['create_date']))
                    ];
                }
            } catch (\Exception $e) {
                // Em caso de erro, retorna valores padrão
            }
            return ['valor' => 'N/A', 'variacao' => 0, 'atualizacao' => '--:--'];
        });
        
        $pageTitle = 'Dashboard';
        return view('dashboard.index', compact('mo_total_gold','mo_total_usd','vendas','pageTitle','cotacao_dolar','cotacao_ouro'));
    }
    public function profile()
    {
        $pageTitle = 'Profile';
        return view('profile.index', compact('pageTitle'));
    }
    
        public function settings()
    {
        $pageTitle = 'Settings';
        return view('profile.settings', compact('pageTitle'));
    }

    public function obterPrecoProduto($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'message' => 'Produto não encontrado.'
            ], 404);
        }

        return response()->json([
            'id'              => $produto->id,
            'nome'            => $produto->nome,
            'preco_venda_brl' => $produto->preco_venda_brl,
            'preco_venda_usd' => $produto->preco_venda_usd,
            'preco_venda_gold'=> $produto->preco_venda_gold,
            'preco_venda_euro'=> $produto->preco_venda_euro,
        ]);
    }

}
