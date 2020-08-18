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
            var id = $(obj).attr('data-id');
            console.log(id)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: deleteFileAjax,
                type: 'post',
                dataType: 'json',
                data: {
                    id: id
                },

                success: function (json) {
                    if (json.result == true) {
                        $(obj).closest('tr').remove();
                        alertify.success('Registro excluído com sucesso!')
                    } else {
                        alertify.error('Falha ao excluir o registro!')
                    }
                }
            })
        }
    })
}

var countFiles = 1;

function addFile(){

    input = $('.toclone:last').find('input[type=text]');

    if ($.trim($(input).val()) == '') {
        $(input).parent('div').append('<label id="lb' + countFiles + '-error" class="error">This field is required.</label>');
        return false
    } else {
        $('.toclone:last').find("label[id=lb" + countFiles + "-error]").remove()
    }


    var newel = $('.toclone:last').clone();

    var inputDescription = newel.find('input[type=text]');
    inputDescription.val('').attr('id', 'file' + countFiles).attr('name', 'files[' + countFiles + '][description]');

    var inputImg = newel.find('input[type=file]');
    inputImg.val('').attr('id', 'img' + countFiles).attr('name', 'files[' + countFiles + '][img]');;

    $(newel).insertAfter(".toclone:last");

    inputDescription.focus()

    countFiles++

}
