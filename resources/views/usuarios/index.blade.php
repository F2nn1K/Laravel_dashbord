@extends('layouts.app')
@section('title', 'Usuarios')
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
                            <th>Email</th>
                            <th>Role</th>
                            <th>Cadastro</th>
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
                            <input type="text" name="name" id="name" class="form-control" required>
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
                            <label class="form-label fw-bold">Role:</label>
                            <select name="role" id="role" class="form-select">
                                <option value="">selecione</option>
                                <option value="admin">admin</option>
                                <option value="manager">manager</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Empresa:</label>
                            <select name="empresa_id" id="empresa_id" class="form-select" required>
                                <option value="">selecione</option>
                                @foreach($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Senha:</label>
                            <input type="text" name="password" id="password" class="form-control"
                                placeholder="**********">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Confirme Senha:</label>
                            <input type="text" name="confirm-password" id="confirm-password" class="form-control"
                                placeholder="**********">
                        </div>
                    </div>
                    <hr class="my-4">
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
<div class="modal fade" id="modalUpd" tabindex="-1" aria-labelledby="modalUpdLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdLabel">Editar dados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="{{ __('messages.close') }}"></button>
            </div>
            <div class="modal-body">

                <form id="frmUpdPerson" class="mb-3" action="#" method="POST">

                    <div class="row g-3">

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Nome <b class="text-danger">*</b></h6>
                            <input type="text" class="form-control" name="name" id="name" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">CPF <b class="text-danger">*</b></h6>
                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF da pessoa" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Telefone</h6>
                            <input type="text" class="form-control" name="telefono1" id="telefono1"
                                placeholder="Telefone" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Telefone secundário</h6>
                            <input type="text" class="form-control" name="telefono2" id="telefono2"
                                placeholder="Telefone secundário" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">CEP</h6>
                            <input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Estado</h6>
                            <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Barrio</h6>
                            <input type="text" class="form-control" name="barrio" id="barrio" placeholder="Barrio" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Rua</h6>
                            <input type="text" class="form-control" name="rua" id="rua" placeholder="Rua" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Complemento</h6>
                            <input type="text" class="form-control" name="complemento" id="complemento"
                                placeholder="Complemento" />
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
                            <h6 class="text-dark fw-400">Ponto Referência</h6>
                            <input type="text" class="form-control" name="ponto_referencia" id="ponto_referencia"
                                placeholder="Ponto Referência" />
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
<script src="/js/Usuarios/IuViIndex.js"></script>

<link href="/template/assets/css/personalized_sweetalert.css" rel="stylesheet" type="text/css" />
@endsection