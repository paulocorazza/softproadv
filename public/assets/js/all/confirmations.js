$(document).ready(function () {
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




    $('#tabela').on('click', '.j_link_delete', function (e) {

        e.preventDefault();

        var href =  $(this).attr('href');


        reset();

        alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
            if (e) {
                window.location = href;
            }

        })
    })

    //deleta registro mestre
    $('.j_delete').on('click', function (e) {
        e.preventDefault();

        reset();

        alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
            if (e) {
                $('#formDelete').submit();
            }

        })
    })

});
