var id = '';

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

function limparAndamento() {
    $('#progress_created_at').val('');
    $('#progress_description').val('');
    $('#progress_date_term').val('');
    $('#progress_publication').val('');
    $('#progress_pending').val('');
}


function editDetail(obj) {
    limparAndamento()

    id = $(obj).closest('tr').attr('data-id');
    var created = $('input[type=date][name="progresses[' + id + '][created_at]"]').val();
    var description = $('input[type=text][name="progresses[' + id + '][description]"]').val();
    var dateTerm = $('input[type=text][name="progresses[' + id + '][date_term]"]').val();
    var publication = $('textarea[name="progresses[' + id + '][publication]"]').val();
    var pending = $('input[type=checkbox][name="progresses[' + id + '][pending]"]').val();


    $('#progress_created_at').val(created);
    $('#progress_description').val(description);
    $('#progress_date_term').val(dateTerm);
    $('#progress_publication').val(publication);
    $('#progress_pending').val(pending);

    $('#modalProgress').modal('show');
}

function removeDetail(obj) {
    reset();

    alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
        if (e) {
            var id = $(obj).closest('tr').attr('data-id');

            if (id <= 0) {
                $(obj).closest('tr').remove();
                alertify.success('Registro excluído com sucesso!')

            } else if (id > 0) {
                deletaProgressAjax(obj, id);
            }
        }
    })
}


function deletaProgressAjax(obj, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: deleteProgressAjax,
        type: 'post',
        dataType: 'json',
        data: {
            id: id
        },

        beforeSend: function () {
            $('.form_load').css('display', 'flex');
        },

        success: function (json) {
            $('.form_load').fadeOut(500);

            if (json.result == true) {
                $(obj).closest('tr').remove();
                alertify.success('Registro excluído com sucesso!')
            } else {
                alertify.error('Falha ao excluir o registro!')
            }
        }
    })
}


$(document).ready(function () {

    $('#btnProgress').on('click', function () {
        id = ''
        limparAndamento();
    })


    var count = 0;

    $('#btnSaveUpdateProgress').on('click', function (e) {
        e.preventDefault();

        if (id != '')
            count = id

        var created_at = $('#progress_created_at').val();
        var description = $('#progress_description').val();
        var date_term = $('#progress_date_term').val();
        var publication = $('#progress_publication').val();



       /* if (contact_name == '') {
            alertify.error('Nome de preenchimento obrigatório!')
            return false
        }*/

        console.log(pending)
        var td =
            '<td>' +
            '<input type="hidden" name="progresses[' + count + '][id]"  value="' + count + '"> ' +

            '<input type="hidden" name="progresses[' + count + '][publication]"  value="' + publication + '"> ' +

            '<input class="form-control" type="date" readonly name="progresses[' + count + '][name]"  value="' + created_at + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly name="progresses[' + count + '][description]"  value="' + description + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly name="progresses[' + count + '][date_term]"  value="' + date_term + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="checkbox"  name="progresses[' + count + '][pending]"' +  ($("#progress_pending").prop('checked') == true)   ? "checked" : "" + '>' +
            '</td>' +

            '<td>' +
            '<a rel="' + count + '" class="badge bg-yellow" href="javascript:;" onclick="editDetail(this)" >Editar</a>' +

            '<a rel="' + count + '" class="badge bg-danger" href="javascript:;" onclick="removeDetail(this)">Excluir</a>' +
            '</td>';

        if (id != '') {
            $('#progress_table').find('.j_list').find('#contacts' + id).html(td);

        } else if (id == '') {
            var novo = '<tr id="progresses' + count + '" data-id ="' + count + '">' + td + '</tr>'

            $('#progress_table').append(novo);

            count--;
        }

        $('#modalProgress').modal('hide');
    })

})
