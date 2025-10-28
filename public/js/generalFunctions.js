function showLoading() {
    Swal.fire({
        title: "<strong>Carregando...</strong>",
        html: `
            <div class="d-flex flex-column align-items-center">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Carregando...</span>
                </div>
                <h5 class="mt-3 text-primary"><b>Por favor, aguarde...</b></h5>
            </div>
        `,
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
    });
}

$(document).ready(function () {
    $("#searchPersonByCpf").val("");

    $('#searchPersonByCpf').on('input', function () {
        let query = $(this).val().trim();

        if (query.length >= 2) {
            $.ajax({
            url: APP_URL + '/gerencia/personas/search',
            method: "GET",
            data: { query: query },
            success: function (response) {
                let html = '';

                if (response.length > 0) {
                html += '<ul class="list-group">';
                response.forEach(function (persona) {
                    html += `<li class="list-group-item">
                    <strong>${persona.nombre}</strong> - CPF: ${persona.cpf}
                     <a href="${APP_URL}/gerencia/personas/show/id/${persona.id}" class="btn btn-sm btn-outline-primary m-2">ver</a>
                    </li>`;
                });
                html += '</ul>';
                } else {
                html = '<p class="text-muted px-3 py-2">No se encontraron resultados.</p>';
                }

                $('#searchResults').html(html);
            },
            error: function () {
                $('#searchResults').html('<p class="text-danger px-3 py-2">Error al buscar personas.</p>');
            }
            });
        } else {
            $('#searchResults').empty();
        }
        });

        // Cerrar resultados al hacer clic fuera
        $(document).on('click', function (e) {
        if (!$(e.target).closest('#searchPersonByCpf, #searchResults').length) {
            $('#searchResults').empty();
        }
    });

});