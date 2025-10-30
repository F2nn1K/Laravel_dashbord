@extends('layouts.app')
@section('title', 'Abrir/ Encerrar Venda')
@section('css')
<!-- DataTables -->
<link href="/template/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/template/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="/template/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Sweet Alert 2 -->
<link href="/template/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Registros /</span>
        {{ $pageTitle }}
    </h4>

    <div class="row mb-4">
        <div class="col-12 col-md-6">
            <button type="button" class="btn btn-success col-12" data-bs-toggle="modal" data-bs-target="#modalAbrirCaixa">
                <b><i class="tf-icons bx bx-log-in me-1"></i>Abrir Caixa</b>
            </button>
        </div>
        <div class="col-12 col-md-6">
            <button type="button" class="btn btn-danger col-12" data-bs-toggle="modal" data-bs-target="#modalFecharCaixa">
                <b><i class="tf-icons bx bx-log-out me-1"></i>Fechar Caixa</b>
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

<!-- Modal Abrir Caixa -->
<div class="modal fade" id="modalAbrirCaixa" tabindex="-1" aria-labelledby="modalAbrirCaixaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalAbrirCaixaLabel"><i class="bx bx-log-in me-2"></i>Abrir Caixa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Fechar"></button>
            </div>
            <div class="modal-body">

                <form id="frmAbrirCaixa" class="mb-3" action="#" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Data de Abertura:</label>
                            <input type="date" class="form-control" name="fe_abrir_vendas" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Hora de Abertura:</label>
                            <input type="time" class="form-control" name="hr_abrir_vendas" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Preço Venda Dólar (por carrada):</label>
                            <input type="number" name="preco_venda_usd" id="preco_venda_usd" class="form-control"
                                placeholder="0.00" step="0.01" min="0" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Preço Venda Ouro (por carrada):</label>
                            <input type="number" name="preco_venda_gold" id="preco_venda_gold" class="form-control"
                                placeholder="0.00" step="0.01" min="0" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Quantidade de Carradas Disponíveis:</label>
                            <input type="number" name="ca_disponivel" id="ca_disponivel" class="form-control"
                                placeholder="0" step="1" min="0" required>
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
                                        class=" bx bx-save me-1"></i>Salvar</b></button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Fechar Caixa -->
<div class="modal fade" id="modalFecharCaixa" tabindex="-1" aria-labelledby="modalFecharCaixaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalFecharCaixaLabel"><i class="bx bx-log-out me-2"></i>Fechar Caixa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="frmFecharCaixa" class="mb-3" action="#" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Data de Fechamento:</label>
                            <input type="date" class="form-control" name="fe_encerrar_vendas" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Hora de Fechamento:</label>
                            <input type="time" class="form-control" name="hr_encerrar_vendas" required>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label fw-bold">Selecione o Período para Fechar:</label>
                            <select name="periodo_id" id="periodo_id" class="form-select" required>
                                <option value="">Selecione um período aberto</option>
                                <!-- Será preenchido via AJAX com períodos abertos -->
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-end mt-4">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <button type="submit" class="btn btn-danger col-12">
                                <b><i class="bx bx-x me-1"></i>Fechar Caixa</b>
                            </button>
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
<script src="/template/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/template/assets/vendor/libs/popper/popper.js"></script>
<script src="/template/assets/vendor/js/bootstrap.js"></script>
<script src="/template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/template/assets/vendor/js/menu.js"></script>

<!-- Main JS -->
<script src="/template/assets/js/main.js"></script>

<!-- Required datatable js -->
<script src="/template/libs/datatables/jquery.dataTables.min.js"></script>
<script src="/template/libs/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="/template/libs/datatables/dataTables.buttons.min.js"></script>
<script src="/template/libs/datatables/buttons.bootstrap4.min.js"></script>
<script src="/template/libs/datatables/jszip.min.js"></script>
<script src="/template/libs/datatables/pdfmake.min.js"></script>
<script src="/template/libs/datatables/vfs_fonts.js"></script>
<script src="/template/libs/datatables/buttons.html5.min.js"></script>
<script src="/template/libs/datatables/buttons.print.min.js"></script>
<script src="/template/libs/datatables/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="/template/libs/datatables/dataTables.responsive.min.js"></script>
<script src="/template/libs/datatables/responsive.bootstrap4.min.js"></script>

<!-- Sweet Alert 2  -->
<script src="/template/libs/sweetalert2/sweetalert2.all.min.js"></script>

<script>
    window.APP_URL = "http://localhost:8001";
</script>

<!-- Personalized Js -->
<script src="/js/generalFunctions.js"></script>
<script src="/js/AbrirEncerrarVenda/IuViIndex.js"></script>

<link href="/template/assets/css/personalized_sweetalert.css" rel="stylesheet" type="text/css" />
@endsection
