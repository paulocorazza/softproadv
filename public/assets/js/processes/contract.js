
function reset() {
    $("#toggleCSS").attr("href", "alertify.default.css");

    alertify.set({
        labels: {
            ok: "Sim",
            cancel: "Não"
        },
        delay: 5000,
        buttonReverse: true,
        buttonFocus: "ok"
    });
}


$(document).ready(function () {

    $('#btnSaveUpdateContract').on('click', function (e) {
        e.preventDefault();

        var contract = $( "#all_contracts option:selected" ).val();

        editor.setData(contract)

        $('#modalContract').modal('hide');
    })

 /*   $('#preview').on('click', function (e) {
        e.preventDefault()

        var dados = $('#formRegister').serialize()

        ajaxSumit(dados, submitPreview)
    })


    function ajaxSumit(dados, urlAjax) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'PUT',
            url: urlAjax,
            data: dados,
            beforeSend: startPreloader()
        }).done(function (data) {
                endPreloader()

        }).fail(function () {
            alertify.alert('Ocorreu um erro na requisição.');
            endPreloader()
        });
    }

    function startPreloader() {
        $('.preload .form_load').fadeIn()
    }

    function endPreloader() {
        $('.preload .form_load').fadeOut();
    }*/

})

