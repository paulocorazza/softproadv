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
    $('#progress_date').val('');
    $('#progress_description').val('');
    $('#progress_date_term').val('');
    $('#progress_publication').val('');
    $('#progress_pending').val('');
}


function editDetail(obj) {
    limparAndamento()

    id = $(obj).closest('tr').attr('data-id');
    var created = $('input[type=date][name="progresses[' + id + '][date]"]').val();
    var description = $('input[type=text][name="progresses[' + id + '][description]"]').val();
    var dateTerm = $('input[type=date][name="progresses[' + id + '][date_term]"]').val();

    var publication = $('input[type=hidden][name="progresses[' + id + '][publication]"]').val();



    var pending = ($('input[type=checkbox][name="progresses[' + id + '][pending]"]').prop('checked') == true) ? true : false;



    $('#progress_date').val(created);
    $('#progress_description').val(description);
    $('#progress_date_term').val(dateTerm);
    $('#progress_publication').val(publication);

    $('#progress_pending').prop("checked", pending);

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

       // var date = $('#progress_date').val();
        var date = $('#progress_date').val();
        var description = $('#progress_description').val();
        var date_term = $('#progress_date_term').val();
        var publication = $('#progress_publication').val();
        var pending = ($("#progress_pending").prop('checked') == true) ? "checked" : '';


        if (date == '') {
            alertify.error('Data é de preenchimento obrigatório!')
            return false
        }

        if (description == '') {
            alertify.error('Descrição é de preenchimento obrigatório!')
            return false
        }


        if (date_term == '') {
            alertify.error('Prazo é de preenchimento obrigatório!')
            return false
        }

        if (publication == '') {
            alertify.error('Publicação é de preenchimento obrigatório!')
            return false
        }

        var td =
            '<td>' +
            '<input type="hidden" id="id' + count + '" name="progresses[' + count + '][id]"  value="' + count + '"> ' +

            '<input type="hidden" id="publication' + count + '" name="progresses[' + count + '][publication]"  value="' + publication + '"> ' +

            '<input class="form-control" type="date" readonly id="date' + count + '" name="progresses[' + count + '][date]"  value="' + date + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly id="description' + count + '" name="progresses[' + count + '][description]"  value="' + description + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="date" readonly  id="term' + count + '" name="progresses[' + count + '][date_term]"  value="' + date_term + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="checkbox" id="pending' + count + '" name="progresses[' + count + '][pending]"' +  pending +' >' +
            '</td>' +

            '<td>' +
            '<a rel="' + count + '" class="badge bg-yellow" href="javascript:;" onclick="editDetail(this)" >Editar</a>' +

            '<a rel="' + count + '" class="badge bg-danger" href="javascript:;" onclick="removeDetail(this)">Excluir</a>' +
            '</td>';


        if (id != '') {
            $('#progress_table').find('.j_list').find('#progresses' + id).html(td);

        } else if (id == '') {
            var novo = '<tr id="progresses' + count + '" data-id ="' + count + '">' + td + '</tr>'

            $('#progress_table').append(novo);

            count--;
        }

        $('#modalProgress').modal('hide');
    })

})
