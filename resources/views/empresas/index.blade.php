@extends('layouts.app')
@section('title', 'Empresas')
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
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Responsavel</th>
                            <th>Telefone</th>
                            <th>Email</th>
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
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Descricao:</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Responsavel:</label>
                            <input type="text" name="responsavel" id="responsavel" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" class="form-control" required>
                        </div>
                    </div>
                    <hr class="my-4">
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
<div class="modal fade" id="modalUpd" tabindex="-1" aria-labelledby="modalUpdLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdLabel">Editar dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="{{ __('messages.close') }}"></button>
            </div>
            <div class="modal-body">

                <form id="frmUpd" class="mb-3" action="#" method="POST">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Descricao:</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Responsavel:</label>
                            <input type="text" name="responsavel" id="responsavel" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" class="form-control" required>
                        </div>
                             <div class="col-md-6">
                            <label class="form-label fw-bold">Estatus:</label>
                            <select name="in_estatus" id="in_estatus" class="form-select">
                                <option value="">seleccione</option>
                                <option value="ativo">ativo</option>
                                <option value="inativo">inativo</option>
                            </select>
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
<script src="{{ asset('js/Empresas/IuViIndex.js') }}"></script>

<link href="{{ asset('template/assets/css/personalized_sweetalert.css') }}" rel="stylesheet"
    type="text/css" />

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
@endsection
