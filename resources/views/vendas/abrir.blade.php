@extends('layouts.app')
@section('title', 'Abrir/ Encerrar Venda')
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
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Registros /</span>
        {{ $pageTitle }}
    </h4>

    <div class="row mb-4">
        <div class="col-12 text-end">
            <button type="button" class="btn btn-primary col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3"
                data-bs-toggle="modal" data-bs-target="#modalAdd">
                <b><i class="tf-icons bx bx-plus me-1"></i>Novo</b>
            </button>
        </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">

        <div class="card">
            <h5 class="card-header">{{ $pageTitle }}</h5>
            <div class="table-responsive text-nowrap">
                <table id="tblRelatorio" class="table">
                    <thead>
                        <tr>
                            <th>ações</th>
                            <th>Baixar</th>
                            <th>Data Abrir</th>
                            <th>Hora Abrir</th>
                            <th>Data Abrir</th>
                            <th>Hora Encerrar</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr class="my-5" />

</div>

<!-- Modals -->

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLabel">Novo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="{{ __('messages.close') }}"></button>
            </div>
            <div class="modal-body">

                <form id="frmAdd" class="mb-3" action="#" method="POST">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Data Abrir Vendas:</label>
                            <input type="date" class="form-control" name="fe_abrir_vendas">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Hora:</label>
                            <input type="time" class="form-control" name="hr_abrir_vendas">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Data Encerrar Vendas:</label>
                            <input type="date" class="form-control" name="fe_encerrar_vendas">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Hora:</label>
                            <input type="time" class="form-control" name="hr_encerrar_vendas">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Preço Venta Dólar:</label>
                            <input type="number" name="preco_venda_usd" id="preco_venda_usd" class="form-control"
                                placeholder="0.00" step="0.01" min="0">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Preço Venta Ouro:</label>
                            <input type="number" name="preco_venda_gold" id="preco_venda_gold" class="form-control"
                                placeholder="0.00" step="0.01" min="0">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Quantidade Disponível:</label>
                            <input type="number" name="ca_disponivel" id="ca_disponivel" class="form-control"
                                placeholder="0.00" step="0.01" min="0">
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-bold d-block">Venda Autorizada Para:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aut_associados"
                                    name="aut_associados">
                                <label class="form-check-label" for="associados">Associados</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aut_investidores"
                                    name="aut_investidores">
                                <label class="form-check-label" for="investidores">Investidores</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aut_outros" name="aut_outros">
                                <label class="form-check-label" for="outros">Outros</label>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end mt-4">

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <button type="submit"
                                class="btn btn-primary col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><b><i
                                        class=" bx bx-save me-1"></i>{{ __('messages.send') }}</b></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Upd -->
<div class="modal fade" id="modalUpd" tabindex="-1" aria-labelledby="updModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updModalLabel">Editar dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="{{ __('messages.close') }}"></button>
            </div>
            <div class="modal-body">

                <form id="frmUpd" class="mb-3" action="#" method="POST">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Data Abrir Vendas:</label>
                            <input type="date" class="form-control" id="fe_abrir_vendas" name="fe_abrir_vendas">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Hora:</label>
                            <input type="time" class="form-control" id="hr_abrir_vendas" name="hr_abrir_vendas">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Data Encerrar Vendas:</label>
                            <input type="date" class="form-control" id="fe_encerrar_vendas" name="fe_encerrar_vendas">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-bold">Hora:</label>
                            <input type="time" class="form-control" id="hr_encerrar_vendas" name="hr_encerrar_vendas">
                        </div>


                        <div class="col-md-3">
                            <label class="form-label fw-bold">Preço Venta Dólar:</label>
                            <input type="number" name="preco_venda_usd" id="preco_venda_usd" class="form-control"
                                placeholder="0.00" step="0.01" min="0">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Preço Venta Ouro:</label>
                            <input type="number" name="preco_venda_gold" id="preco_venda_gold" class="form-control"
                                placeholder="0.00" step="0.01" min="0">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-bold">Quantidade Disponível:</label>
                            <input type="number" name="ca_disponivel" id="ca_disponivel" class="form-control"
                                placeholder="0.00" step="0.01" min="0">
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-bold d-block">Venda Autorizada Para:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aut_associados"
                                    name="aut_associados">
                                <label class="form-check-label" for="associados">Associados</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aut_investidores"
                                    name="aut_investidores">
                                <label class="form-check-label" for="investidores">Investidores</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="aut_outros" name="aut_outros">
                                <label class="form-check-label" for="outros">Outros</label>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end mt-4">

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <button type="submit"
                                class="btn btn-primary col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><b><i
                                        class=" bx bx-save me-1"></i>{{ __('messages.send') }}</b></button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
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
<script src="{{ asset('js/AbrirEncerrarVenda/IuViIndex.js') }}"></script>

<link href="{{ asset('template/assets/css/personalized_sweetalert.css') }}" rel="stylesheet"
    type="text/css" />

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
@endsection
