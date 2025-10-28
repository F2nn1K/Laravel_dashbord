const APP_URL = window.APP_URL || '';

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#frmRegister').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: APP_URL + '/register',
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
                    window.location.href = APP_URL + '/dashboard';
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
});