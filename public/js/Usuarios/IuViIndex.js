const APP_URL = window.APP_URL || '';

$(document).ready(function () {
    $('#tblRelatorio').DataTable({
        responsive: false,
        dom: "Bfrtip",
        lengthChange: false,
        autoWidth: true,
        searching: true,
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        order: [[1, "desc"]],
        info: false,
        ajax: APP_URL + '/usuario/all',
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return `
               <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                                <button type="button" id="btnEdt" class="dropdown-item" data-url="${APP_URL}/usuario/edt/id/" data-url-frm="${APP_URL}/usuario/upd/id/" data-id="${row.id}"> <i class="bx bx-edit-alt me-1"></i> Editar </button>
                                <button  type="button" id="btnDelete" class="dropdown-item" data-url="${APP_URL}/usuario/del/id/" data-tbl-name="tblRelatorio" data-id="${row.id}"> <i class="bx bx-trash me-1"></i> Eliminar </button>
                            </div>
                        </div>
                    `;
                }
            },
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'role' },
            { data: 'cadastro' },
            {
                data: 'in_estatus',
                render: function (data) {
                    if (data === "ativo") {
                        return `<span class="text-success me-1">Ativo</span>`;
                    } else {
                        return `<span class="text-danger me-1">Inativo</span>`;
                    }
                }
            }
        ],
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).off('click', '#btnEdt').on('click', '#btnEdt', updRow);
    $(document).off('click', '#btnDelete').on('click', '#btnDelete', delRow);

    $('#frmAdd').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: APP_URL + '/usuario/add',
            data: $(this).serialize(),
            type: "post",
            dataType: "json",
            beforeSend: function () {
                showLoading();
            },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    text: response.message,
                    timer: 3000,
                }).then(function () {
                    $("#modalAdd").modal("hide");
                    $("#frmAdd")[0].reset();
                    $("#tblRelatorio").DataTable().ajax.reload();
                });
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    text: xhr.responseJSON.message,
                    timer: 5000,
                });
            },
        });
    });

    $('#frmUpd').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr("action"),
            data: $(this).serialize(),
            type: "post",
            dataType: "json",
            beforeSend: function () {
                showLoading();
            },
            success: function (response) {
                if (response.status != false) {
                    Swal.fire({
                        icon: "success",
                        text: response.message,
                        timer: 3000,
                    }).then(function () {
                        $("#modalUpd").modal("hide");
                        $("#frmUpd")[0].reset();
                        $("#tblRelatorio").DataTable().ajax.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        text: response.message,
                        timer: 3000,
                    });
                }

            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    text: xhr.responseJSON.message,
                    timer: 5000,
                });
            },
        });
    });

    function updRow() {

        var id = $(this).attr("data-id");
        let url = $(this).attr("data-url") + id;
        let urlFrm = $(this).attr("data-url-frm") + id;

        $.ajax({
            url: url,
            type: "get",
            dataType: "json",
            success: function (res) {
                $("#frmUpd").attr("action", urlFrm);
                $("#modalUpd #nome").val(res.data.nome);
                $("#modalUpd #endereco").val(res.data.endereco);
                $("#modalUpd #telefone").val(res.data.telefone);
                $("#modalUpd #rampa").val(res.data.rampa);
                $("#modalUpd #aut_nome").val(res.data.aut_nome);
                $("#modalUpd #aut_telefone").val(res.data.aut_telefone);
                $("#modalUpd #doc_identificacao").val(res.data.doc_identificacao);
                $("#modalUpd #associado").val(res.data.associado);
                $("#modalUpd #contrato").val(res.data.contrato);
                $("#modalUpd #in_estatus").val(res.data.in_estatus).trigger('change');

                $("#modalUpd").modal("show");

            },
            error: function (data) {
                Swal.fire({
                    icon: "error",
                    text: "Erro ao obter dados da perssoa",
                    timer: 3000,
                });
            },
        });
    }

    function delRow() {
        var id = $(this).attr("data-id");
        let url = $(this).attr("data-url") + id;
        let tbl = $(this).attr("data-tbl-name");

        Swal.fire({

            title: "Excluir este registro?",
            text: "Esta ação não pode ser desfeita.",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: "Continue",
            cancelButtonText: "Cancel",

        }).then(function (result) {
            if (result.value == true) {
                $.ajax({
                    url: url,
                    data: { id: id },
                    type: "get",
                    dataType: "json",
                    success: function (response) {
                        if (response.status != false) {
                            Swal.fire({
                                icon: "success",
                                text: response.message,
                                timer: 3000,
                            }).then(function () {
                                $("#" + tbl + "").DataTable().ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                text: response.message,
                                timer: 3000,
                            });
                        }

                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            text: xhr.responseJSON.message,
                            timer: 5000,
                        });
                    },
                });
            }
        });
    }

});