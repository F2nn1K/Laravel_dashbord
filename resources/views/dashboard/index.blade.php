@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        
        <!-- Título -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="fw-bold">Dashboard</h4>
                <p class="text-muted mb-0">Bem-vindo, {{ auth()->user()->name ?? 'Usuário' }}! Acompanhe as operações em tempo real.</p>
            </div>
        </div>

        <!-- Cards de Métricas -->
        <div class="row">
            <!-- Card: Faturamento Total Hoje -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-trending-up text-primary"></i>
                                </span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Faturamento Hoje</span>
                        <h3 class="card-title mb-2">$ {{ number_format($faturamento_total, 2, ',', '.') }}</h3>
                        <small class="text-success fw-semibold">
                            <i class="bx bx-up-arrow-alt"></i> {{ $vendas->count() }} vendas
                        </small>
                    </div>
                </div>
            </div>

            <!-- Card: Carradas Vendidas -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="bx bxs-truck text-info"></i>
                                </span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Carradas Hoje</span>
                        <h3 class="card-title mb-2">{{ $vendas->sum('ca_produto') }}</h3>
                        <small class="text-muted">Total de carradas de ouro vendidas</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendas por Moeda -->
        <div class="row">
            <!-- Vendas em Dólar -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-dollar text-success fs-4"></i>
                                </span>
                            </div>
                            <div>
                                <span class="d-block mb-1">Vendas em Dólar</span>
                                <h3 class="card-title text-nowrap mb-0">${{ number_format($mo_total_usd, 2, ',', '.') }}</h3>
                            </div>
                        </div>
                        <small class="text-muted">Pagamentos em USD</small>
                    </div>
                </div>
            </div>

            <!-- Vendas em Ouro -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="bx bxs-diamond text-warning fs-4"></i>
                                </span>
                            </div>
                            <div>
                                <span class="d-block mb-1">Vendas em Ouro</span>
                                <h3 class="card-title text-nowrap mb-0">{{ number_format($mo_total_gold, 2, ',', '.') }} Dwt</h3>
                            </div>
                        </div>
                        <small class="text-muted">Pagamentos em GOLD</small>
                    </div>
                </div>
            </div>

            <!-- Clientes Atendidos -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-group text-primary fs-4"></i>
                                </span>
                            </div>
                            <div>
                                <span class="d-block mb-1">Clientes Hoje</span>
                                <h3 class="card-title text-nowrap mb-0">{{ $vendas->unique('nb_cliente')->count() }}</h3>
                            </div>
                        </div>
                        <small class="text-muted">Clientes únicos atendidos</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="row">
            <!-- Gráfico: Vendas por Forma de Pagamento -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Vendas por Forma de Pagamento</h5>
                        <small class="text-muted">Hoje</small>
                    </div>
                    <div class="card-body">
                        <div id="graficoFormasPagamento"></div>
                    </div>
                </div>
            </div>

            <!-- Gráfico: Tendência de Vendas (7 dias) -->
            <div class="col-lg-8 col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Tendência de Vendas</h5>
                        <small class="text-muted">Últimos 7 dias</small>
                    </div>
                    <div class="card-body">
                        <div id="graficoTendenciaVendas"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimas Vendas -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">
                            <i class="bx bxs-diamond text-warning"></i> Últimas Vendas
                        </h5>
                        <a href="{{ route('relatorio.venda') }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class="bx bx-file-blank"></i> Relatório Completo
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Rampa</th>
                                        <th>Forma Pagamento</th>
                                        <th class="text-end">Valor Total</th>
                                        <th>Data/Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($vendas as $venda)
                                        <tr>
                                            <td>
                                                <strong>{{ $venda->nb_cliente }}</strong>
                                            </td>
                                            <td>{{ $venda->nb_produto }}</td>
                                            <td>
                                                <span class="badge bg-label-info">{{ $venda->ca_produto }} carradas</span>
                                            </td>
                                            <td>Rampa {{ $venda->nu_rampa }}</td>
                                            <td>
                                                <span class="badge {{ $venda->tp_pagamento == 'usd' ? 'bg-label-success' : ($venda->tp_pagamento == 'gold' ? 'bg-label-warning' : 'bg-label-primary') }}">
                                                    {{ strtoupper($venda->tp_pagamento) }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <strong class="{{ $venda->tp_pagamento == 'usd' ? 'text-success' : 'text-warning' }}">
                                                    {{ $venda->tp_pagamento == 'usd' ? '$' : '' }}{{ number_format($venda->mo_total, 2, ',', '.') }}{{ $venda->tp_pagamento == 'gold' ? ' Dwt' : '' }}
                                                </strong>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ date('d/m/Y H:i', strtotime($venda->fe_add)) }}</small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="bx bx-info-circle"></i> Nenhuma venda registrada hoje
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Footer -->
    @include('partials.footer')
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
@endsection
@section('js')
<!-- Core JS -->
<script src="/template/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/template/assets/vendor/libs/popper/popper.js"></script>
<script src="/template/assets/vendor/js/bootstrap.js"></script>
<script src="/template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/template/assets/vendor/js/menu.js"></script>
<!-- ApexCharts -->
<script src="/template/assets/vendor/libs/apex-charts/apexcharts.js"></script>
<!-- Main JS -->
<script src="/template/assets/js/main.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // Gráfico 1: Vendas por Forma de Pagamento (Donut)
    const vendasPorPagamento = {
        series: [
            {{ $vendas_por_pagamento['usd'] }},
            {{ $vendas_por_pagamento['gold'] }},
            {{ $vendas_por_pagamento['brl'] }},
            {{ $vendas_por_pagamento['euro'] }}
        ],
        labels: ['Dólar (USD)', 'Ouro (GOLD)', 'Real (BRL)', 'Euro (EUR)'],
        colors: ['#28c76f', '#ff9f43', '#00cfe8', '#7367f0'],
        chart: {
            type: 'donut',
            height: 300
        },
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                            }
                        }
                    }
                }
            }
        }
    };
    
    if (document.querySelector("#graficoFormasPagamento")) {
        const chartPagamento = new ApexCharts(document.querySelector("#graficoFormasPagamento"), vendasPorPagamento);
        chartPagamento.render();
    }

    // Gráfico 2: Tendência de Vendas (Linha + Barras)
    const tendenciaVendas = {
        series: [{
            name: 'Vendas',
            type: 'line',
            data: {!! json_encode($grafico_vendas) !!}
        }, {
            name: 'Carradas',
            type: 'column',
            data: {!! json_encode($grafico_carradas) !!}
        }],
        chart: {
            height: 300,
            type: 'line',
            toolbar: {
                show: false
            }
        },
        stroke: {
            width: [4, 0],
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '50%'
            }
        },
        colors: ['#696cff', '#ff9f43'],
        xaxis: {
            categories: {!! json_encode($grafico_dias) !!}
        },
        yaxis: [{
            title: {
                text: 'Número de Vendas'
            }
        }, {
            opposite: true,
            title: {
                text: 'Carradas'
            }
        }],
        legend: {
            position: 'top'
        }
    };
    
    if (document.querySelector("#graficoTendenciaVendas")) {
        const chartTendencia = new ApexCharts(document.querySelector("#graficoTendenciaVendas"), tendenciaVendas);
        chartTendencia.render();
    }
});
</script>
@endsection
