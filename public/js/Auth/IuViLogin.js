const APP_URL = window.APP_URL || '';

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#frmAuth').on('submit', function (e) {
        e.preventDefault();
        
        const formData = $(this).serialize();
        console.log('Enviando dados:', formData);
        console.log('URL:', APP_URL + '/logon');
        
        $.ajax({
            url: APP_URL + '/logon',
            data: formData,
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
                    window.location.href = APP_URL + '/dashboard';
                });
            },
            error: function (xhr) {
                let errorMessage = 'Erro ao tentar fazer login. Tente novamente.';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status === 0) {
                    errorMessage = 'Erro de conexão. Verifique se o servidor está rodando.';
                } else if (xhr.status === 401) {
                    errorMessage = 'Usuário ou senha incorretos';
                }
                
                Swal.fire({
                    icon: "error",
                    text: errorMessage,
                    timer: 5000,
                });
            },
        });
    });
});