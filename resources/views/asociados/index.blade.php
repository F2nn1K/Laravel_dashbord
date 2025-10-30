@extends('layouts.app')
@section('title', 'Asociados')
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
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Rampa</th>
                            <th>Estado</th>
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
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Novo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="{{ __('messages.close') }}"></button>
            </div>
            <div class="modal-body">

                <form id="frmAdd" class="mb-3" action="#" method="POST">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome / Name:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Endereço:</label>
                            <input type="text" name="endereco" id="endereco" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Telefone:</label>
                            <input type="tel" name="telefone" id="telefone" class="form-control" pattern="[0-9\s\-\+\(\)]*" title="Apenas números são permitidos" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold">Rampa:</label>
                            <input type="text" name="rampa" id="rampa" class="form-control" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h6 class="fw-bold text-uppercase mt-3">Autorizado para Compra Carrada</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome / Name:</label>
                            <input type="text" name="aut_nome" id="aut_nome" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Telefone:</label>
                            <input type="tel" name="aut_telefone" id="aut_telefone" class="form-control" pattern="[0-9\s\-\+\(\)]*" title="Apenas números são permitidos" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Inserir Doc. Identificação:</label>
                            <input type="file" name="doc_identificacao" id="doc_identificacao" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Inserir Arquivo Contrato:</label>
                            <input type="file" name="contrato" id="contrato" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Estatus:</label>
                            <select name="in_estatus" id="in_estatus" class="form-select" required>
                                <option value="">seleccione</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
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

<!-- Modal Upd -->
<div class="modal fade" id="modalUpd" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Editar dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="{{ __('messages.close') }}"></button>
            </div>
            <div class="modal-body">

                <form id="frmUpd" class="mb-3" action="#" method="POST">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome / Name:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Endereço:</label>
                            <input type="text" name="endereco" id="endereco" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-bold">Telefone:</label>
                            <input type="tel" name="telefone" id="telefone" class="form-control" pattern="[0-9\s\-\+\(\)]*" title="Apenas números são permitidos" required>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-bold">Rampa:</label>
                            <input type="text" name="rampa" id="rampa" class="form-control" required>
                        </div>
                    </div>
                    <hr class="my-4">
                    <h6 class="fw-bold text-uppercase mt-3">Autorizado para Compra Carrada</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome / Name:</label>
                            <input type="text" name="aut_nome" id="aut_nome" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Telefone:</label>
                            <input type="tel" name="aut_telefone" id="aut_telefone" class="form-control" pattern="[0-9\s\-\+\(\)]*" title="Apenas números são permitidos">
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Inserir Doc. Identificação:</label>
                            <input type="file" name="doc_identificacao" id="doc_identificacao" class="form-control">
                        </div>
                         <div class="col-md-6">
                            <label class="form-label fw-bold">Inserir Arquivo Contrato:</label>
                            <input type="file" name="contrato" id="contrato" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Estatus:</label>
                            <select name="in_estatus" id="in_estatus" class="form-select" required>
                                <option value="">seleccione</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
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
    window.APP_URL = "{{ config('app.url') }}" || window.location.origin;
</script>

<!-- Bloquear letras nos campos de telefone -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecionar todos os inputs de telefone
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    
    phoneInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            // Permitir apenas números, espaços, +, -, (, )
            this.value = this.value.replace(/[^0-9\s\+\-\(\)]/g, '');
        });
        
        // Prevenir colar texto com letras
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const cleanedText = pastedText.replace(/[^0-9\s\+\-\(\)]/g, '');
            document.execCommand('insertText', false, cleanedText);
        });
    });
});
</script>

<!-- Personalized Js -->
<script src="/js/generalFunctions.js"></script>
<script src="/js/Asociados/IuViIndex.js"></script>

<link href="/template/assets/css/personalized_sweetalert.css" rel="stylesheet" type="text/css" />
@endsection
