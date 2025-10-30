const APP_URL = window.APP_URL || '';

$(document).ready(function () {
    $('#tblRelatorio').DataTable({
        responsive: false,
        dom: "frtip",
        lengthChange: false,
        autoWidth: true,
        searching: true,
        order: [[0, "desc"]],
        info: false,
        ajax: APP_URL + '/produto/all',
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return `
               <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                                <button type="button" id="btnEdt" class="dropdown-item" data-url="${APP_URL}/produto/edt/id/" data-url-frm="${APP_URL}/produto/upd/id/" data-id="${row.id}"> <i class="bx bx-edit-alt me-1"></i> Editar </button>
                                <button  type="button" id="btnDelete" class="dropdown-item" data-url="${APP_URL}/produto/del/id/" data-tbl-name="tblRelatorio" data-id="${row.id}"> <i class="bx bx-trash me-1"></i> Eliminar </button>
                            </div>
                        </div>
                    `;
                }
            },
            { data: 'codigo' },
            { data: 'nome' },
            { data: 'preco_venda_usd' },
            { data: 'preco_venda_gold' },
            {
                data: 'in_estatus',
                render: function (data) {
                    if (data === "ativo") {
                        return `<span class="text-success me-1">ativo</span>`;
                    } else {
                        return `<span class="text-danger me-1">inativo</span>`;
                    }
                }
            },
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
            url: APP_URL + '/produto/add',
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
                    $("#modal-add-person").modal("hide");
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
                $("#modalUpd #codigo").val(res.data.codigo);
                $("#modalUpd #nome").val(res.data.nome);
                $("#modalUpd #descricao").val(res.data.descricao);
                $("#modalUpd #estoque_minimo").val(res.data.estoque_minimo);
                $("#modalUpd #custo").val(res.data.custo);
                $("#modalUpd #preco_venda_brl").val(res.data.preco_venda_brl);
                $("#modalUpd #preco_venda_usd").val(res.data.preco_venda_usd);
                $("#modalUpd #preco_venda_gold").val(res.data.preco_venda_gold);
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