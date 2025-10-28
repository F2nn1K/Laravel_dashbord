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
        order: [[2, "desc"]],
        info: false,
        ajax: APP_URL + '/abrir-encerrar-venda/all',
        columns: [
            {
                data: null,
                render: function (data, type, row) {
                    return `
               <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                            <div class="dropdown-menu">
                                <button type="button" id="btnEdt" class="dropdown-item" data-url="${APP_URL}/abrir-encerrar-venda/edt/id/" data-url-frm="${APP_URL}/abrir-encerrar-venda/upd/id/" data-id="${row.id}"> <i class="bx bx-edit-alt me-1"></i> Editar </button>
                                <button  type="button" id="btnDelete" class="dropdown-item" data-url="${APP_URL}/abrir-encerrar-venda/del/id/" data-tbl-name="tblRelatorio" data-id="${row.id}"> <i class="bx bx-trash me-1"></i> Eliminar </button>
                            </div>
                        </div>
                    `;
                }
            },
            {
                data: 'id',
                render: function (data) {
                    return `<a href="${APP_URL}/relatorio/venda" target="_blank" class="btn rounded-pill btn-icon btn-primary">
                              <span class="tf-icons bx bx-import"></span>
                            </a>`;
                }
            },
            { data: 'fe_abrir_vendas' },
            { data: 'hr_abrir_vendas' },
            { data: 'fe_encerrar_vendas' },
            { data: 'hr_encerrar_vendas' },
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
        console.log($(this).serialize());
        e.preventDefault();
        $.ajax({
            url: APP_URL + '/abrir-encerrar-venda/add',
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
                console.log(res.data);
                $("#frmUpd").attr("action", urlFrm);
                const dtFeA = new Date(res.data.fe_abrir_vendas); // ISO string or valid date
                const dateA = dtFeA.toISOString().slice(0, 10); // "2025-10-12"
                const fullTimeA = res.data.hr_abrir_vendas;
                const timeA = fullTimeA.slice(0, 5); // "18:40"

                $("#modalUpd #fe_abrir_vendas").val(dateA);
                $("#modalUpd #hr_abrir_vendas").val(timeA);

                const dtFeE = new Date(res.data.fe_encerrar_vendas); // ISO string or valid date
                const dateE = dtFeE.toISOString().slice(0, 10); // "2025-10-12"
                const fullTimeE = res.data.hr_encerrar_vendas;
                const timeE = fullTimeE.slice(0, 5); // "18:40"

                $("#modalUpd #fe_encerrar_vendas").val(dateE);
                $("#modalUpd #hr_encerrar_vendas").val(timeE);

                $("#modalUpd #aut_associados").prop("checked", true);  // ON
                $("#modalUpd #ca_disponivel").val(res.data.ca_disponivel);


                // Set checkboxes
                $("#modalUpd #aut_associados").prop("checked", toChecked(res.data.aut_associados));
                $("#modalUpd #aut_investidores").prop("checked", toChecked(res.data.aut_investidores));
                $("#modalUpd #aut_outros").prop("checked", toChecked(res.data.aut_outros));

                $("#modalUpd #preco_venda_usd").val(res.produto.preco_venda_usd)
                $("#modalUpd #preco_venda_gold").val(res.produto.preco_venda_gold)
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

    // Helper function to normalize any truthy value to boolean (for checkbox)
    function toChecked(val) {
        return val == 1 || val === "1" || val === "on" || val === true || val === "Y";
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