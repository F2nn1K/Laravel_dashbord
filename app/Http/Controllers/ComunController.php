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
        try {
            // Vendas de hoje
            $vendas          = Venda::whereDate('fe_add', today())->orderBy('fe_add', 'desc')->get();
            $mo_total_usd    = $vendas->where('tp_pagamento', 'usd')->sum('mo_total');
            $mo_total_gold   = $vendas->where('tp_pagamento', 'gold')->sum('mo_total');
            $mo_total_brl    = $vendas->where('tp_pagamento', 'brl')->sum('mo_total');
            $mo_total_euro   = $vendas->where('tp_pagamento', 'euro')->sum('mo_total');
        } catch (\Exception $e) {
            // Se der erro, usar valores padrão
            $vendas = collect([]);
            $mo_total_usd = 0;
            $mo_total_gold = 0;
            $mo_total_brl = 0;
            $mo_total_euro = 0;
        }
        
        try {
            // Calcular faturamento total (convertendo tudo para USD)
            $faturamento_total = $mo_total_usd + ($mo_total_gold * 0.1);
            
            // Dados para gráficos - últimos 7 dias
            $vendas_7_dias = Venda::where('fe_add', '>=', now()->subDays(6)->startOfDay())
                ->selectRaw('DATE(fe_add) as data, COUNT(*) as total, SUM(ca_produto) as carradas')
                ->groupBy('data')
                ->orderBy('data')
                ->get();
        } catch (\Exception $e) {
            $faturamento_total = 0;
            $vendas_7_dias = collect([]);
        }
        
        // Preparar dados para o gráfico de tendência
        $grafico_dias = [];
        $grafico_vendas = [];
        $grafico_carradas = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $data = now()->subDays($i)->format('Y-m-d');
            $dia = now()->subDays($i)->format('d/m');
            $venda_dia = $vendas_7_dias->firstWhere('data', $data);
            
            $grafico_dias[] = $dia;
            $grafico_vendas[] = $venda_dia ? $venda_dia->total : 0;
            $grafico_carradas[] = $venda_dia ? $venda_dia->carradas : 0;
        }
        
        // Vendas por forma de pagamento (para gráfico de pizza)
        $vendas_por_pagamento = [
            'usd' => $vendas->where('tp_pagamento', 'usd')->count(),
            'gold' => $vendas->where('tp_pagamento', 'gold')->count(),
            'brl' => $vendas->where('tp_pagamento', 'brl')->count(),
            'euro' => $vendas->where('tp_pagamento', 'euro')->count(),
        ];
        
        // Cotações desabilitadas (não estão sendo usadas no dashboard)
        $cotacao_dolar = ['valor' => 'N/A', 'variacao' => 0, 'atualizacao' => '--:--'];
        $cotacao_ouro = ['valor' => 'N/A', 'variacao' => 0, 'atualizacao' => '--:--'];
        
        /* // Buscar cotação do Dólar (API AwesomeAPI - mais confiável)
        $cotacao_dolar = Cache::remember('cotacao_dolar_awesome', 1800, function () {
            try {
                // AwesomeAPI tem dados em tempo real, incluindo fins de semana
                $response = Http::timeout(5)->get('https://economia.awesomeapi.com.br/json/last/USD-BRL');
                
                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['USDBRL'])) {
                        $usd = $data['USDBRL'];
                        return [
                            'valor' => number_format((float)$usd['bid'], 4, ',', '.'),
                            'variacao' => (float)$usd['pctChange'],
                            'atualizacao' => date('H:i', strtotime($usd['create_date']))
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Erro ao buscar cotação do dólar: ' . $e->getMessage());
            }
            
            // Fallback: tentar API do BCB
            try {
                $hoje = date('m-d-Y');
                $url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='{$hoje}'&\$top=1&\$format=json";
                $response = Http::withoutVerifying()->timeout(10)->get($url);
                
                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['value'][0])) {
                        $valorAtual = (float)$data['value'][0]['cotacaoVenda'];
                        return [
                            'valor' => number_format($valorAtual, 4, ',', '.'),
                            'variacao' => 0,
                            'atualizacao' => date('H:i')
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Erro fallback BCB dólar: ' . $e->getMessage());
            }
            
            return ['valor' => 'N/A', 'variacao' => 0, 'atualizacao' => '--:--'];
        }); */
        
        $pageTitle = 'Dashboard';
        return view('dashboard.index', compact(
            'mo_total_gold','mo_total_usd','mo_total_brl','mo_total_euro',
            'vendas','pageTitle','cotacao_dolar','cotacao_ouro','faturamento_total',
            'grafico_dias','grafico_vendas','grafico_carradas','vendas_por_pagamento'
        ));
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
