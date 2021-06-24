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



function removeFile(obj) {
    reset();

    alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
        if (e) {
                $(obj).closest('.toclone').remove();
                alertify.success('Registro excluído com sucesso!')
        }
    })
}

var countFiles = 1;

function addFile(){

    input = $('.toclone:last').find('input[type=text]');

    if ($.trim($(input).val()) == '') {
        $(input).parent('div').append('<label id="lb' + countFiles + '-error" class="error">Campo de preenchimento obrigatório.</label>');
        return false
    } else {
        $('.toclone:last').find("label[id=lb" + countFiles + "-error]").remove()
    }


    var newel = $('.toclone:last').clone();

    var inputDescription = newel.find('input[type=text]');
    inputDescription.val('').attr('id', 'instructions' + countFiles).attr('name', 'instructions[' + countFiles + '][instruction]');

    $(newel).insertAfter(".toclone:last");

    inputDescription.focus()

    countFiles--

}
