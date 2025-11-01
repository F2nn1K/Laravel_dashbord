<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;


class RelatorioController extends Controller
{
    public function index()
{
    $pageTitle = 'Relatorios';
    return view('relatorios.index', compact('pageTitle'));
}
 public function vendas()
    {
        $data = [
            'titulo' => 'Reporte de Ventas',
            'fecha' => date('d/m/Y'),
            'ventas' => [
                ['producto' => 'Café', 'cantidad' => 10, 'precio' => 25],
                ['producto' => 'Azúcar', 'cantidad' => 5, 'precio' => 12],
            ]
        ];

        $pdf = Pdf::loadView('relatorios.vendas', $data);

        // Opción 1: descargar
        return $pdf->download('reporte_ventas.pdf');

        // Opción 2: ver en el navegador
        // return $pdf->stream('reporte_ventas.pdf');
    }

    public function vendasData($inicio, $fin)
    {
        // Convertir las fechas al formato correcto
        $fechaInicio = date('d/m/Y', strtotime($inicio));
        $fechaFin = date('d/m/Y', strtotime($fin));

    // Obtener datos de la base de datos
    $registros = Venda::where('in_estatus', 'ativo')
        ->whereBetween('fe_add', [$fechaInicio, $fechaFin])
        ->get();

    // Agrupar por data, rampa, nome
    $agrupados = $registros->groupBy(function ($item) {
        return Carbon::parse($item->fe_add)->format('Y-m-d')
. '-' . $item->nu_rampa . '-' . $item->nb_cliente;
    });

    // Procesar cada grupo para armar el arreglo final
    $vendas = [];

    foreach ($agrupados as $grupo => $items) {
        $quantLoad = $items->sum('ca_produto');
        $pgtoDolar = $items->where('tp_pagamento', 'usd')->sum('mo_total');
        $pgtoEuro = $items->where('tp_pagamento', 'euro')->sum('mo_total');
        $pgtoGold = $items->where('tp_pagamento', 'gold')->sum('mo_total');

        $item = $items->first();

        $vendas[] = [
            'data' => Carbon::parse($item->fe_add)->format('Y-m-d'),
            'rampa' => $item->nu_rampa,
            'nome' => $item->nb_cliente,
            'quant_load' => $quantLoad,
            'pgto_dolar' => $pgtoDolar,
            'pgto_euro' => $pgtoEuro,
            'pgto_gold' => $pgtoGold,
        ];
    }

    // Calcular totales
    $totais = [
        'quant_load' => collect($vendas)->sum('quant_load'),
        'pgto_dolar' => collect($vendas)->sum('pgto_dolar'),
        'pgto_gold' => collect($vendas)->sum('pgto_gold'),
    ];
    $pdf = Pdf::loadView('relatorios.vendas-data', [
        'titulo' => 'Relatorio de Venda Diaria',
        'vendas' => $vendas,
        'data_inicial' => '2025-09-01',
        'data_final' => '2025-09-30',
        'totais' => $totais,
        'data_hoje' => Carbon::now()->format('d \d\e F \d\e Y'),
    ]);

        // Mostrar en el navegador (puedes cambiar a download si quieres)
        return $pdf->stream("reporte_vendas_{$inicio}_{$fin}.pdf");
    }

    public function gerarRelatorioVenda()
    {
    $fecha = Carbon::now();
    $dataInicial = $fecha->copy()->startOfDay(); 
    $dataFinal = $fecha->copy()->endOfDay();
    // Obtener datos de la base de datos
    $registros = Venda::where('in_estatus', 'ativo')
        ->whereBetween('fe_add', [$dataInicial, $dataFinal])
        ->get();

    // Agrupar por data, rampa, nome
    $agrupados = $registros->groupBy(function ($item) {
        return Carbon::parse($item->fe_add)->format('Y-m-d')
. '-' . $item->nu_rampa . '-' . $item->nb_cliente;
    });

    // Procesar cada grupo para armar el arreglo final
    $vendas = [];

    foreach ($agrupados as $grupo => $items) {
        $quantLoad = $items->sum('ca_produto');
        $pgtoDolar = $items->where('tp_pagamento', 'usd')->sum('mo_total');
        $pgtoEuro = $items->where('tp_pagamento', 'euro')->sum('mo_total');
        $pgtoGold = $items->where('tp_pagamento', 'gold')->sum('mo_total');

        $item = $items->first();

        $vendas[] = [
            'data' => Carbon::parse($item->fe_add)->format('Y-m-d'),
            'rampa' => $item->nu_rampa,
            'nome' => $item->nb_cliente,
            'quant_load' => $quantLoad,
            'pgto_dolar' => $pgtoDolar,
            'pgto_euro' => $pgtoEuro,
            'pgto_gold' => $pgtoGold,
        ];
    }

    // Calcular totales
    $totais = [
        'quant_load' => collect($vendas)->sum('quant_load'),
        'pgto_dolar' => collect($vendas)->sum('pgto_dolar'),
        'pgto_gold' => collect($vendas)->sum('pgto_gold'),
    ];

    $pdf = Pdf::loadView('relatorios.venda', [
        'titulo' => 'Relatorio de Venda Diaria',
        'vendas' => $vendas,
        'data_inicial' => $dataInicial,
        'data_final' => $dataFinal,
        'totais' => $totais,
        'data_hoje' => Carbon::now()->format('d \d\e F \d\e Y'),
    ]);
    $dataHoraAtual = now()->format('Y-m-d_H-i-s');
    return $pdf->stream("relatorio_venda_{$dataHoraAtual}.pdf");
    }

    public function relatorioGeralCliente()
{
    // Criando dados simulados para clientes
    $clientes = [
        (object)[
            'inscricao' => '12345',
            'rampa' => 'Rampa A',
            'nome_associado' => 'João Silva',
            'nome_investidor' => 'Investidor 1'
        ],
        (object)[
            'inscricao' => '67890',
            'rampa' => 'Rampa B',
            'nome_associado' => 'Maria Oliveira',
            'nome_investidor' => 'Investidor 2'
        ],
        (object)[
            'inscricao' => '11223',
            'rampa' => 'Rampa C',
            'nome_associado' => 'Carlos Souza',
            'nome_investidor' => 'Investidor 3'
        ],
        (object)[
            'inscricao' => '44556',
            'rampa' => 'Rampa D',
            'nome_associado' => 'Ana Costa',
            'nome_investidor' => 'Investidor 4'
        ]
    ];


    $pdf = Pdf::loadView('relatorios.cliente-general', compact('clientes'));
    $dataHoraAtual = now()->format('Y-m-d_H-i-s');
    return $pdf->stream("relatorio-geral-cliente_{$dataHoraAtual}.pdf");
}

    public function relatorioGeralAsociado()
{
    // Criando dados simulados para clientes
    $clientes = [
        (object)[
            'inscricao' => '12345',
            'rampa' => 'Rampa A',
            'nome_associado' => 'João Silva',
            'nome_investidor' => 'Investidor 1'
        ],
        (object)[
            'inscricao' => '67890',
            'rampa' => 'Rampa B',
            'nome_associado' => 'Maria Oliveira',
            'nome_investidor' => 'Investidor 2'
        ],
        (object)[
            'inscricao' => '11223',
            'rampa' => 'Rampa C',
            'nome_associado' => 'Carlos Souza',
            'nome_investidor' => 'Investidor 3'
        ],
        (object)[
            'inscricao' => '44556',
            'rampa' => 'Rampa D',
            'nome_associado' => 'Ana Costa',
            'nome_investidor' => 'Investidor 4'
        ]
    ];


    $pdf = Pdf::loadView('relatorios.cliente-general', compact('clientes'));
    $dataHoraAtual = now()->format('Y-m-d_H-i-s');
    return $pdf->stream("relatorio-geral-cliente_{$dataHoraAtual}.pdf");
}

    // Modelo de Gestão - Página de Filtros
    public function modeloGestao()
    {
        $pageTitle = 'Modelo de Gestão';
        return view('relatorios.modelo-gestao', compact('pageTitle'));
    }

    // Modelo de Gestão - Gerar PDF
    public function gerarModeloGestao(Request $request)
    {
        $dados = [];
        
        // Filtrar por nome se fornecido
        $nomeFiltro = $request->input('nome_filtro');
        
        // Associados
        if ($request->has('tipo_associados')) {
            $query = \App\Models\Asociado::where('in_estatus', 'ativo');
            if ($nomeFiltro) {
                $query->where('nome', 'LIKE', "%{$nomeFiltro}%");
            }
            $associados = $query->get();
            
            foreach ($associados as $item) {
                $dados[] = [
                    'inscricao' => $item->id,
                    'rampa' => $item->rampa,
                    'nome' => $item->nome,
                ];
            }
        }
        
        // Investidores
        if ($request->has('tipo_investidores')) {
            $query = \App\Models\Investidor::where('in_estatus', 'ativo');
            if ($nomeFiltro) {
                $query->where('nome', 'LIKE', "%{$nomeFiltro}%");
            }
            $investidores = $query->get();
            
            foreach ($investidores as $item) {
                $dados[] = [
                    'inscricao' => $item->id,
                    'rampa' => $item->rampa,
                    'nome' => $item->nome,
                ];
            }
        }
        
        // Outros
        if ($request->has('tipo_outros')) {
            $query = \App\Models\Outro::where('in_estatus', 'ativo');
            if ($nomeFiltro) {
                $query->where('nome', 'LIKE', "%{$nomeFiltro}%");
            }
            $outros = $query->get();
            
            foreach ($outros as $item) {
                $dados[] = [
                    'inscricao' => $item->id,
                    'rampa' => $item->rampa,
                    'nome' => $item->nome,
                ];
            }
        }
        
        $pdf = Pdf::loadView('relatorios.modelo-gestao-pdf', [
            'titulo' => 'RELATÓRIO GERAL',
            'dados' => $dados,
            'data_hoje' => Carbon::now()->format('d \d\e F \d\e Y'),
        ]);
        
        $dataHoraAtual = now()->format('Y-m-d_H-i-s');
        return $pdf->stream("modelo_gestao_{$dataHoraAtual}.pdf");
    }

    // Modelo de Gestão 2 (com Assinatura) - Página de Filtros
    public function modeloGestao2()
    {
        $pageTitle = 'Modelo de Gestão 2';
        return view('relatorios.modelo-gestao-2', compact('pageTitle'));
    }

    // Modelo de Gestão 2 - Gerar PDF
    public function gerarModeloGestao2(Request $request)
    {
        $dados = [];
        
        // Filtrar por nome se fornecido
        $nomeFiltro = $request->input('nome_filtro');
        
        // Associados
        if ($request->has('tipo_associados')) {
            $query = \App\Models\Asociado::where('in_estatus', 'ativo');
            if ($nomeFiltro) {
                $query->where('nome', 'LIKE', "%{$nomeFiltro}%");
            }
            $associados = $query->get();
            
            foreach ($associados as $item) {
                $dados[] = [
                    'inscricao' => $item->id,
                    'rampa' => $item->rampa,
                    'nome' => $item->nome,
                ];
            }
        }
        
        // Investidores
        if ($request->has('tipo_investidores')) {
            $query = \App\Models\Investidor::where('in_estatus', 'ativo');
            if ($nomeFiltro) {
                $query->where('nome', 'LIKE', "%{$nomeFiltro}%");
            }
            $investidores = $query->get();
            
            foreach ($investidores as $item) {
                $dados[] = [
                    'inscricao' => $item->id,
                    'rampa' => $item->rampa,
                    'nome' => $item->nome,
                ];
            }
        }
        
        // Outros
        if ($request->has('tipo_outros')) {
            $query = \App\Models\Outro::where('in_estatus', 'ativo');
            if ($nomeFiltro) {
                $query->where('nome', 'LIKE', "%{$nomeFiltro}%");
            }
            $outros = $query->get();
            
            foreach ($outros as $item) {
                $dados[] = [
                    'inscricao' => $item->id,
                    'rampa' => $item->rampa,
                    'nome' => $item->nome,
                ];
            }
        }
        
        $pdf = Pdf::loadView('relatorios.modelo-gestao-2-pdf', [
            'titulo' => 'RELATÓRIO GERAL',
            'dados' => $dados,
            'data_hoje' => Carbon::now()->format('d \d\e F \d\e Y'),
        ]);
        
        $dataHoraAtual = now()->format('Y-m-d_H-i-s');
        return $pdf->stream("modelo_gestao_2_{$dataHoraAtual}.pdf");
    }

}
