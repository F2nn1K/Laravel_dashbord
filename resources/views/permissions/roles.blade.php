@extends('layouts.app')
@section('title', 'Gerenciar Perfis')
@section('css')
<link href="/template/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<style>
.permission-group {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    background: #f9f9f9;
}
.permission-group h6 {
    color: #696cff;
    font-weight: bold;
    margin-bottom: 15px;
}
</style>
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <i class="bx bx-group text-primary"></i> {{ $pageTitle }}
    </h4>
    <p class="text-muted">Configure perfis de usuários e suas permissões</p>

    <div class="row">
        <!-- Lista de Perfis -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Perfis Disponíveis ({{ count($roles) }})</h5>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddRole">
                        <i class="bx bx-plus"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($roles as $role)
                        <a href="#" class="list-group-item list-group-item-action role-item" data-role-id="{{ $role->id }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-0">{{ $role->name }}</h6>
                                    <small class="text-muted">{{ $role->code }}</small>
                                </div>
                                <i class="bx bx-chevron-right"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Detalhes do Perfil -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-white">
                        <i class="bx bx-shield me-2"></i> Detalhes do Perfil
                    </h5>
                </div>
                <div class="card-body" id="roleDetails">
                    <div class="text-center text-muted py-5">
                        <i class="bx bx-left-arrow-circle" style="font-size: 48px;"></i>
                        <p class="mt-3">Selecione um perfil ao lado para gerenciar suas permissões</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Criar Perfil -->
<div class="modal fade" id="modalAddRole" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Novo Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="frmAddRole">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nome do Perfil:</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Código:</label>
                        <input type="text" name="code" class="form-control" required>
                        <small class="text-muted">Ex: admin, manager, vendedor</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Descrição:</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Criar Perfil
                        </button>
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

<!-- Sweet Alert 2 -->
<script src="/template/libs/sweetalert2/sweetalert2.all.min.js"></script>

<script>
    window.APP_URL = "{{ config('app.url') }}" || window.location.origin;
</script>

<script src="/js/generalFunctions.js"></script>

<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    const permissions = @json($permissions);

    // Selecionar perfil
    $('.role-item').on('click', function(e) {
        e.preventDefault();
        $('.role-item').removeClass('active');
        $(this).addClass('active');
        
        const roleId = $(this).data('role-id');
        loadRoleDetails(roleId);
    });

    function loadRoleDetails(roleId) {
        $.ajax({
            url: APP_URL + '/perfis/edt/id/' + roleId,
            type: "get",
            success: function(res) {
                const role = res.data;
                const rolePermissions = res.permissions || [];

                let html = `
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4>${role.name}</h4>
                                <p class="text-muted mb-0">${role.description || 'Sem descrição'}</p>
                            </div>
                            <button class="btn btn-sm btn-outline-danger btnDeleteRole" data-id="${role.id}">
                                <i class="bx bx-trash me-1"></i> Excluir Perfil
                            </button>
                        </div>
                    </div>
                    <hr>
                    <form id="frmUpdateRole" data-role-id="${role.id}">
                        <h6 class="mb-3">
                            <i class="bx bx-checkbox-checked me-2"></i>Selecione as Permissões:
                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" id="btnSelectAll">Selecionar Todas</button>
                        </h6>
                `;

                // Agrupar por módulo
                Object.keys(permissions).forEach(function(module) {
                    html += `
                        <div class="permission-group">
                            <h6><i class="bx bx-folder me-2"></i>${module || 'Geral'}</h6>
                            <div class="row">
                    `;

                    permissions[module].forEach(function(perm) {
                        const checked = rolePermissions.includes(perm.id) ? 'checked' : '';
                        html += `
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input permission-check" type="checkbox" 
                                           name="permissions[]" value="${perm.id}" id="perm_${perm.id}" ${checked}>
                                    <label class="form-check-label" for="perm_${perm.id}">
                                        ${perm.name}
                                        <br><small class="text-muted">${perm.description || ''}</small>
                                    </label>
                                </div>
                            </div>
                        `;
                    });

                    html += `
                            </div>
                        </div>
                    `;
                });

                html += `
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bx bx-save me-2"></i> Salvar Alterações
                            </button>
                        </div>
                    </form>
                `;

                $('#roleDetails').html(html);

                // Selecionar todas
                $('#btnSelectAll').on('click', function() {
                    $('.permission-check').prop('checked', true);
                });

                // Submit atualizar permissões
                $('#frmUpdateRole').on('submit', function(e) {
                    e.preventDefault();
                    const roleId = $(this).data('role-id');
                    
                    $.ajax({
                        url: APP_URL + '/perfis/upd/id/' + roleId,
                        data: $(this).serialize() + '&name=' + role.name + '&code=' + role.code,
                        type: "post",
                        beforeSend: showLoading,
                        success: function(response) {
                            Swal.fire({
                                icon: "success",
                                text: "Permissões atualizadas com sucesso!",
                                timer: 2000,
                            }).then(() => {
                                // Recarregar a página para mostrar as mudanças
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                text: xhr.responseJSON?.message || "Erro ao atualizar permissões",
                                timer: 5000,
                            });
                        }
                    });
                });

                // Deletar perfil
                $('.btnDeleteRole').on('click', function() {
                    const id = $(this).data('id');
                    Swal.fire({
                        title: "Excluir este perfil?",
                        text: "Todos os usuários com este perfil perderão acesso!",
                        icon: "error",
                        showCancelButton: true,
                        confirmButtonText: "Sim, excluir",
                        cancelButtonText: "Cancelar"
                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                url: APP_URL + '/perfis/del/id/' + id,
                                type: "get",
                                success: function() {
                                    Swal.fire({
                                        icon: "success",
                                        text: "Perfil excluído!",
                                        timer: 2000,
                                    }).then(() => location.reload());
                                }
                            });
                        }
                    });
                });
            }
        });
    }

    // Criar perfil
    $('#frmAddRole').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: APP_URL + '/perfis/add',
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
                    text: xhr.responseJSON?.message || "Erro ao criar perfil",
                    timer: 5000,
                });
            },
        });
    });
});
</script>
@endsection

