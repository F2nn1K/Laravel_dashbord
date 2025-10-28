@extends('layouts.app')
@section('title', 'Relatorios')
@section('css')
<!-- DataTables -->
<link href="{{ asset('template/libs/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
<link href="{{ asset('template/libs/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('template/libs/datatables/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />

<!-- Sweet Alert 2 -->
<link href="{{ asset('template/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
    type="text/css">
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Gerar /</span>
        {{ $pageTitle }}
    </h4>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
        <div class="card p-5">
            <h5 class="card-header">Gerar Relatório</h5>

            <form action="/gerar-relatorio" method="POST">
                <!-- Se usas Laravel, no olvides esto: -->
                <!-- @csrf -->

                <div class="row g-3 mt-3">

                    <!-- Título do Relatório -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Título do Relatório:</label>
                        <input type="text" name="titulo_relatorio" id="titulo_relatorio" class="form-control"
                            placeholder="Ex: Relatório de Vendas">
                    </div>

                    <!-- Período: Data Inicial -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Data Inicial:</label>
                        <input type="date" name="data_inicial" id="data_inicial" class="form-control">
                    </div>

                    <!-- Período: Data Final -->
                    <div class="col-md-3">
                        <label class="form-label fw-bold">Data Final:</label>
                        <input type="date" name="data_final" id="data_final" class="form-control">
                    </div>

                    <!-- Filtro por Usuário -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Usuário:</label>
                        <select name="usuario_id" id="usuario_id" class="form-select">
                            <option value="">TODO</option>
                            <option value="1">João Silva</option>
                            <option value="2">Maria Souza</option>
                            <!-- Preencher dinamicamente no backend -->
                        </select>
                    </div>

                    <!-- Filtro por Status -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Estatus:</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">TODO</option>
                            <option value="aberto">Aberto</option>
                            <option value="processando">Processando</option>
                            <option value="concluido">Concluído</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                    </div>

                    <!-- Tipo de Arquivo -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Formato do Relatório:</label>
                        <select name="formato" id="formato" class="form-select">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel (.xlsx)</option>
                        </select>
                    </div>

                    <!-- Idioma (reutilizado do anterior) -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Idioma:</label>
                        <select name="idioma" id="idioma" class="form-select">
                            <option value="pt">Português (Brasil)</option>
                            <option value="es">Español</option>
                            <option value="en">English</option>
                            <option value="fr">Français</option>
                        </select>
                    </div>

                    <!-- Fonte (reutilizado) -->
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Fonte do Relatório:</label>
                        <select name="tipo_fonte" id="tipo_fonte" class="form-select">
                            <option value="arial">Arial</option>
                            <option value="roboto">Roboto</option>
                            <option value="times">Times New Roman</option>
                            <option value="open_sans">Open Sans</option>
                            <option value="poppins">Poppins</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary px-4">Gerar Relatório</button>
                </div>
            </form>
            <hr class="my-5" />
            <h5 class="card-header">Outros Relatórios</h5>
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card bg-secondary text-white mb-2">
                        <div class="card-header">Venda Diaria <i class="tf-icons bx bx-layout"></i></div>
                        <div class="card-body">
                            <p class="card-text"> <a target="_blank" href="{{ route('relatorio.venda') }}" class="btn btn-primary btn-lg">Gerar</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5" />
</div>

<!-- Footer -->
@include('partials.footer')
<!-- / Footer -->
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

<!-- Main JS -->
<script src="{{ asset('template/assets/js/main.js') }}"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- Required datatable js -->
<script src="{{ asset( 'template/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Buttons examples -->
<script src="{{ asset( 'template/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/jszip.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset( 'template/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset( 'template/libs/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Sweet Alert 2  -->
<script src="{{ asset('template/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
    window.APP_URL = "{{ url('/') }}";

</script>

<!-- Personalized Js -->
<script src="{{ asset('js/generalFunctions.js') }}"></script>
<script src="{{ asset('js/Produtos/IuViIndex.js') }}"></script>

<link href="{{ asset('template/assets/css/personalized_sweetalert.css') }}" rel="stylesheet"
    type="text/css" />

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
@endsection
