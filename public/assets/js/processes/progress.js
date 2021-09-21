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
    $('#process_category').val('Outros').trigger('change');
    $('#progress_date').val('');
    $('#progress_description').val('');
    $('#progress_date_term').val('');
    $('#progress_publication').val('');
    $('#progress_concluded').val('');
}


function editDetail(obj) {
    limparAndamento()

    id = $(obj).closest('tr').attr('data-id');
    var created = $('input[type=text][name="progresses[' + id + '][date]"]').val();
    var description = $('input[type=text][name="progresses[' + id + '][description]"]').val();
    var dateTerm = $('input[type=text][name="progresses[' + id + '][date_term]"]').val();
    var publication = $('input[type=hidden][name="progresses[' + id + '][publication]"]').val();
    var concluded = ($('input[type=checkbox][name="progresses[' + id + '][concluded]"]').prop('checked') == true) ? true : false;
    var category = $('select[name="progresses[' + id + '][category]"]').val();


    $('#progress_date').val(moment(created, "DD/MM/YYYY").format("YYYY-MM-DD"));
    $('#progress_description').val(description);
    $('#progress_date_term').val(moment(dateTerm, "DD/MM/YYYY").format("YYYY-MM-DD"));
    $('#progress_publication').val(publication);
    $('#progress_concluded').prop("checked", concluded);
    $('#process_category').val(category);
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


        var date = moment($('#progress_date').val()).format("DD/MM/YYYY")
        var description = $('#progress_description').val();
        var date_term = moment($('#progress_date_term').val()).format("DD/MM/YYYY")
        var publication = $('#progress_publication').val();
        var concluded = ($("#progress_concluded").prop('checked') == true) ? "checked" : '';
        var category =  $('#process_category').val();

        if (date === 'Invalid date') {
            alertify.error('Data é de preenchimento obrigatório!')
            return false
        }

        if (description == '') {
            alertify.error('Descrição é de preenchimento obrigatório!')
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

            '<input class="form-control" type="text" readonly id="date' + count + '" name="progresses[' + count + '][date]"  value="' + date + '"> ' +
            '</td>' +

            '<td>' +
                '<select class="form-control" readonly name="progresses[' + count + '][category]">' +
                '<option value="' + category + '">' + category + '</option>' +
                '</select>' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly id="description' + count + '" name="progresses[' + count + '][description]"  value="' + description + '"> ' +
            '</td>'

        if (date_term === 'Invalid date') {
            td +=
                '<td>' +
                '<input class="form-control" type="text" readonly  id="term' + count + '" name="progresses[' + count + '][date_term]"> ' +
                '</td>';
        } else {
            td +=
                '<td>' +
                '<input class="form-control" type="text" readonly  id="term' + count + '" name="progresses[' + count + '][date_term]"  value="' + date_term + '"> ' +
                '</td>';
        }

        td +=

        '<td>' +
        '<input class="form-control" type="checkbox" id="concluded' + count + '" name="progresses[' + count + '][concluded]"' + concluded + ' >' +
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
