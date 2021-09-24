function generateApiJuzBrasil(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/tenants/companies/token-juzbrasil',
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },

        beforeSend: function () {
            $('.input-group .form_load').css('display', 'flex');
        },

        success: function (json) {
            console.log(json)
            $('.input-group .form_load').fadeOut(500);

            if (json) {
                $('#token_juzbrazil').val(json)

            } else {
                alertify.error('Falha ao criar o token')
            }
        }
    })
}

$(document).ready(function () {
    $("#btnJuzBrasil").on('click', function (e) {
        e.preventDefault();

        let id = $(this).attr('data-id');
        generateApiJuzBrasil(id)
    })
})
