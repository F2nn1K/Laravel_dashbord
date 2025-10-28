@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Bem-vindo {{ Auth::user()->name }}! 🏔️</h5>
                                <p class="mb-4">
                                    <strong>Marudi Mountain - Compra e Venda de Ouro</strong><br>
                                    Acompanhe as cotações, vendas e operações em tempo real.
                                </p>

                                <a href="{{ route('venda') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bx bx-plus"></i> Nova Venda
                                </a>
                                <a href="{{ route('abrir-encerrar-venda') }}" class="btn btn-sm btn-outline-success ms-2">
                                    <i class="bx bx-time"></i> Gerenciar Períodos
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('template/assets/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140" alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/wallet.png') }}"
                                            alt="chart success" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                            <a class="dropdown-item" href="javascript:void(0);">saiba mais</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Cotação Dólar</span>
                                <h3 class="card-title mb-2">R$ {{ $cotacao_dolar['valor'] }}</h3>
                                <small class="{{ $cotacao_dolar['variacao'] >= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                                    <i class="bx bx-{{ $cotacao_dolar['variacao'] >= 0 ? 'up' : 'down' }}-arrow-alt"></i>
                                    {{ number_format(abs($cotacao_dolar['variacao']), 2, ',', '.') }}%
                                </small>
                                <small class="text-muted d-block mt-1">Atualizado: {{ $cotacao_dolar['atualizacao'] }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/wallet.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                            <a class="dropdown-item" href="javascript:void(0);">saiba mais</a>
                                        </div>
                                    </div>
                                </div>
                                <span>Cotação Ouro (1 oz)</span>
                                <h3 class="card-title text-nowrap mb-1">R$ {{ $cotacao_ouro['valor'] }}</h3>
                                <small class="{{ $cotacao_ouro['variacao'] >= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                                    <i class="bx bx-{{ $cotacao_ouro['variacao'] >= 0 ? 'up' : 'down' }}-arrow-alt"></i>
                                    {{ number_format(abs($cotacao_ouro['variacao']), 2, ',', '.') }}%
                                </small>
                                <small class="text-muted d-block mt-1">Atualizado: {{ $cotacao_ouro['atualizacao'] }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <h5 class="card-header m-0 me-2 pb-3">Análise de Vendas</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            {{ date('Y') }}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                            <a class="dropdown-item" href="javascript:void(0);">{{ date('Y') - 1 }}</a>
                                            <a class="dropdown-item" href="javascript:void(0);">{{ date('Y') - 2 }}</a>
                                            <a class="dropdown-item" href="javascript:void(0);">{{ date('Y') - 3 }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="growthChart"></div>
                            <div class="text-center fw-semibold pt-3 mb-2">Operações de Ouro</div>

                            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-primary p-2"><i
                                                class="bx bx-dollar text-primary"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>Dólar</small>
                                        <h6 class="mb-0">${{ number_format($mo_total_usd, 2, ',', '.') }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-warning p-2"><i
                                                class="bx bxs-diamond text-warning"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>Ouro</small>
                                        <h6 class="mb-0">{{ number_format($mo_total_gold, 2, ',', '.') }} oz</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/paypal.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="javascript:void(0);">Ver Mais</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block mb-1">Total em Dólar</span>
                                <h3 class="card-title text-nowrap mb-2">${{ number_format($mo_total_usd, 2, ',', '.') }}</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    Vendas USD</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('template/assets/img/icons/unicons/cc-primary.png') }}"
                                            alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="javascript:void(0);">Ver Mais</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Excluir</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total em Ouro</span>
                                <h3 class="card-title mb-2">{{ number_format($mo_total_gold, 2, ',', '.') }} oz</h3>
                                <small class="text-warning fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    Vendas GOLD</small>
                            </div>
                        </div>
                    </div>
                    <!-- </div>
    <div class="row"> -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div
                                        class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2">Movimentação Total</h5>
                                            <span class="badge bg-label-warning rounded-pill">Vendas Hoje</span>
                                        </div>
                                        <div class="mt-sm-auto">
                                            <small class="text-success text-nowrap fw-semibold"><i
                                                    class="bx bx-chevron-up"></i> {{ $vendas->count() }} vendas</small>
                                            <h3 class="mb-0">{{ $vendas->sum('ca_produto') }} carradas</h3>
                                        </div>
                                    </div>
                                    <div id="profileReportChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Estatísticas de Operações</h5>
                            <small class="text-muted">Movimentação de Ouro</small>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="javascript:void(0);">Selecionar Tudo</a>
                                <a class="dropdown-item" href="javascript:void(0);">Atualizar</a>
                                <a class="dropdown-item" href="javascript:void(0);">Compartilhar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2">{{ $vendas->count() }}</h2>
                                <span>Vendas Hoje</span>
                            </div>
                            <div id="orderStatisticsChart"></div>
                        </div>
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-warning"><i
                                            class="bx bxs-truck"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Carradas Vendidas</h6>
                                        <small class="text-muted">LOAD/Carradas de Ouro</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ $vendas->sum('ca_produto') }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-success"><i
                                            class="bx bx-dollar"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Vendas em Dólar</h6>
                                        <small class="text-muted">Pagamento USD</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">${{ number_format($mo_total_usd, 2, ',', '.') }}</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-info"><i
                                            class="bx bxs-diamond"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Vendas em Ouro</h6>
                                        <small class="text-muted">Pagamento GOLD</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ number_format($mo_total_gold, 2, ',', '.') }} oz</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded bg-label-primary"><i
                                            class="bx bx-group"></i></span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Clientes Ativos</h6>
                                        <small class="text-muted">Asociados, Investidores</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">{{ $vendas->unique('nb_cliente')->count() }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->

            <!-- Expense Overview -->
            <div class="col-md-6 col-lg-4 order-1 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-tabs-line-card-income"
                                    aria-controls="navs-tabs-line-card-income" aria-selected="true">
                                    Faturamento
                                </button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab">Custos</button>
                            </li>
                            <li class="nav-item">
                                <button type="button" class="nav-link" role="tab">Margem</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body px-0">
                        <div class="tab-content p-0">
                            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                <div class="d-flex p-4 pt-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ asset('template/assets/img/icons/unicons/wallet.png') }}"
                                            alt="User" />
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Faturamento Total Hoje</small>
                                        <div class="d-flex align-items-center">
                                            <h6 class="mb-0 me-1">${{ number_format($mo_total_usd, 2, ',', '.') }}</h6>
                                            <small class="text-success fw-semibold">
                                                <i class="bx bx-up-arrow-alt"></i>
                                                USD
                                            </small>
                                        </div>
                                        <div class="d-flex align-items-center mt-2">
                                            <h6 class="mb-0 me-1">{{ number_format($mo_total_gold, 2, ',', '.') }} oz</h6>
                                            <small class="text-warning fw-semibold">
                                                <i class="bx bx-up-arrow-alt"></i>
                                                GOLD
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div id="incomeChart"></div>
                                <div class="d-flex justify-content-center pt-4 gap-2">
                                    <div class="flex-shrink-0">
                                        <div id="expensesOfWeek"></div>
                                    </div>
                                    <div>
                                        <p class="mb-n1 mt-1">Transações Hoje</p>
                                        <small class="text-muted">{{ $vendas->count() }} vendas registradas</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Expense Overview -->

            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-2 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">
                            <i class="bx bxs-diamond text-warning"></i> Vendas Recentes
                        </h5>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                <a class="dropdown-item" href="{{ route('relatorio.venda') }}" target="_blank">
                                    <i class="bx bx-file-blank"></i> Relatório Completo
                                </a>
                                <a class="dropdown-item" href="{{ route('venda') }}">
                                    <i class="bx bx-plus"></i> Nova Venda
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @forelse($vendas as $venda)
                                <li class="d-flex mb-3 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded {{ $venda->tp_pagamento == 'usd' ? 'bg-label-success' : 'bg-label-warning' }}">
                                            <i class="{{ $venda->tp_pagamento == 'usd' ? 'bx bx-dollar' : 'bx bxs-diamond' }}"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $venda->nb_cliente }}</h6>
                                            <small class="text-muted">
                                                Rampa {{ $venda->nu_rampa }} • {{ $venda->ca_produto }}x {{ $venda->nb_produto }}
                                            </small>
                                        </div>
                                        <div class="user-progress d-flex flex-column align-items-end">
                                            <h6 class="mb-0 {{ $venda->tp_pagamento == 'usd' ? 'text-success' : 'text-warning' }}">
                                                {{ $venda->tp_pagamento == 'usd' ? '$' : '' }}{{ number_format($venda->mo_total, 2, ',', '.') }}{{ $venda->tp_pagamento == 'gold' ? ' oz' : '' }}
                                            </h6>
                                            <span class="text-muted" style="font-size: 0.75rem;">{{ strtoupper($venda->tp_pagamento) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center text-muted py-4">
                                    <i class="bx bx-info-circle"></i> Nenhuma venda registrada hoje
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->
        </div>
    </div>
    <!-- / Content -->

    <!-- Footer -->
    @include('partials.footer')
    <!-- / Footer -->

    <div class="content-backdrop fade"></div>
</div>
@endsection
@section('js')
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('template/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('template/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('template/assets/vendor/js/bootstrap.js') }}"></script>
<script
    src="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}">
</script>

<script src="{{ asset('template/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('template/assets/vendor/libs/apex-charts/apexcharts.js') }}">
</script>

<!-- Main JS -->
<script src="{{ asset('template/assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('template/assets/js/dashboards-analytics.js') }}"></script>

@endsection
