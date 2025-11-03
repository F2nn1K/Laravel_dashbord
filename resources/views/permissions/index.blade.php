@extends('layouts.app')
@section('title', 'Gerenciar Permissões')
@section('css')
<!-- DataTables -->
<link href="/template/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<!-- Sweet Alert 2 -->
<link href="/template/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <i class="bx bx-key text-primary"></i> {{ $pageTitle }}
    </h4>
    <p class="text-muted">Configure permissões e controle de acesso do sistema</p>

    <!-- Conteúdo: apenas Permissões -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Permissões Disponíveis</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        <i class="bx bx-plus me-1"></i> Nova Permissão
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tblPermissions" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Código</th>
                                    <th>Descrição</th>
                                    <th>Módulo</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td><strong>{{ $permission->name }}</strong></td>
                                    <td><code class="text-danger">{{ $permission->code }}</code></td>
                                    <td>{{ $permission->description }}</td>
                                    <td><span class="badge bg-label-info">{{ $permission->module ?? 'Geral' }}</span></td>
                                    <td>
                                        <span class="badge {{ $permission->in_estatus == 'ativo' ? 'bg-label-success' : 'bg-label-danger' }}">
                                            {{ ucfirst($permission->in_estatus) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-primary btnEdit" data-id="{{ $permission->id }}">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger btnDelete" data-id="{{ $permission->id }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>

<!-- Modal Adicionar -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Permissão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="frmAdd">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome da Permissão:</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Código:</label>
                            <input type="text" name="code" class="form-control" required>
                            <small class="text-muted">Ex: view-dashboard, create-vendas</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Módulo:</label>
                            <select name="module" class="form-select">
                                <option value="">Selecione</option>
                                <option value="dashboard">Dashboard</option>
                                <option value="clientes">Clientes</option>
                                <option value="estoque">Estoque</option>
                                <option value="vendas">Vendas</option>
                                <option value="relatorios">Relatórios</option>
                                <option value="admin">Admin</option>
                                <option value="configuracoes">Configurações</option>
                                <option value="acl">ACL</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Descrição:</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <div class="col-12 col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-save me-1"></i> Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalUpd" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Permissão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="frmUpd">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nome da Permissão:</label>
                            <input type="text" name="name" id="upd_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Código:</label>
                            <input type="text" name="code" id="upd_code" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Módulo:</label>
                            <select name="module" id="upd_module" class="form-select">
                                <option value="">Selecione</option>
                                <option value="dashboard">Dashboard</option>
                                <option value="clientes">Clientes</option>
                                <option value="estoque">Estoque</option>
                                <option value="vendas">Vendas</option>
                                <option value="relatorios">Relatórios</option>
                                <option value="admin">Admin</option>
                                <option value="configuracoes">Configurações</option>
                                <option value="acl">ACL</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status:</label>
                            <select name="in_estatus" id="upd_status" class="form-select">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold">Descrição:</label>
                            <textarea name="description" id="upd_description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <div class="col-12 col-md-4">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-save me-1"></i> Atualizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
@endsection

@section('js')
<!-- Core JS -->
<script src="/template/assets/vendor/libs/jquery/jquery.js"></script>
<script src="/template/assets/vendor/libs/popper/popper.js"></script>
<script src="/template/assets/vendor/js/bootstrap.js"></script>
<script src="/template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="/template/assets/vendor/js/menu.js"></script>
<script src="/template/assets/js/main.js"></script>

<!-- DataTables -->
<script src="/template/libs/datatables/jquery.dataTables.min.js"></script>
<script src="/template/libs/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Sweet Alert 2 -->
<script src="/template/libs/sweetalert2/sweetalert2.all.min.js"></script>

<script>
    window.APP_URL = "{{ config('app.url') }}" || window.location.origin;
</script>

<script src="/js/generalFunctions.js"></script>

<script>
$(document).ready(function() {
    $('#tblPermissions').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json'
        }
    });

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    // Adicionar
    $('#frmAdd').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: APP_URL + '/permission/add',
            data: $(this).serialize(),
            type: "post",
            beforeSend: showLoading,
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    text: response.message,
                    timer: 3000,
                }).then(() => location.reload());
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    text: xhr.responseJSON?.message || "Erro ao criar permissão",
                    timer: 5000,
                });
            },
        });
    });

    // Editar
    $('.btnEdit').on('click', function() {
        const id = $(this).data('id');
        $.ajax({
            url: APP_URL + '/permission/edt/id/' + id,
            type: "get",
            success: function(res) {
                $('#upd_name').val(res.data.name);
                $('#upd_code').val(res.data.code);
                $('#upd_module').val(res.data.module);
                $('#upd_description').val(res.data.description);
                $('#upd_status').val(res.data.in_estatus);
                $('#frmUpd').attr('action', APP_URL + '/permission/upd/id/' + id);
                $('#modalUpd').modal('show');
            }
        });
    });

    // Atualizar
    $('#frmUpd').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: "post",
            beforeSend: showLoading,
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    text: response.message,
                    timer: 3000,
                }).then(() => location.reload());
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    text: xhr.responseJSON?.message || "Erro ao atualizar",
                    timer: 5000,
                });
            },
        });
    });

    // Deletar
    $('.btnDelete').on('click', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: "Excluir permissão?",
            text: "Esta ação não pode ser desfeita.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim, excluir",
            cancelButtonText: "Cancelar"
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: APP_URL + '/permission/del/id/' + id,
                    type: "get",
                    success: function(response) {
                        Swal.fire({
                            icon: "success",
                            text: response.message,
                            timer: 3000,
                        }).then(() => location.reload());
                    }
                });
            }
        });
    });
});
</script>
@endsection

