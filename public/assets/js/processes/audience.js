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

function limparAudience() {
    $('#audiences_users').val("").trigger('change');
    $('#audiences_title').val('');
    $('#audiences_start').val('');
    $('#audiences_end').val('');
    $('#audiences_color').val('');
    $('#audiences_description').val('');
}


function editDetailEvent(obj) {
     limparAudience()

    id = $(obj).closest('tr').attr('data-id');
    var users = $('select[name="audiences[' + id + '][users][]"]').val()
    var title = $('input[type=text][name="audiences[' + id + '][title]"]').val();
    var start = $('input[type=text][name="audiences[' + id + '][start]"]').val();
    var end = $('input[type=text][name="audiences[' + id + '][end]"]').val();
    var description = $('input[type=hidden][name="audiences[' + id + '][description]"]').val();


    $('#audiences_users').val(users).change();
    $('#audiences_title').val(title);
    $('#audiences_start').val(moment(start, "DD/MM/YYYY HH:mm:ss").format('YYYY-MM-DDTHH:mm:ss'));
    $('#audiences_end').val(moment(end, "DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DDTHH:mm:ss"));
    $('#audiences_description').val(description);


    $('#modalAudience').modal('show');
}

function removeDetailEvent(obj) {
    reset();

    alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
        if (e) {
            var id = $(obj).closest('tr').attr('data-id');

            if (id <= 0) {
                $(obj).closest('tr').remove();
                alertify.success('Registro excluído com sucesso!')

            } else if (id > 0) {
                deletaAudienceAjax(obj, id);
            }
        }
    })
}


function deletaAudienceAjax(obj, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: deleteAudienceAjax,
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

    $('#btnAudience').on('click', function () {
        id = ''
        limparAudience();
    })


    var count = 0;

    $('#btnSaveUpdateAudience').on('click', function (e) {
        e.preventDefault();

        if (id != '')
            count = id

        var users = $('#audiences_users').val()
        var description = $('#audiences_description').val();
        var start =  moment($('#audiences_start').val()).format("DD/MM/YYYY HH:mm:ss")
        var end =  moment($('#audiences_end').val()).format("DD/MM/YYYY HH:mm:ss")
        var title = $('#audiences_title').val();


        if (users == '') {
            alertify.error('Advogado é de preenchimento obrigatório!')
            return false
        }
        if (start == 'Invalid date') {
            alertify.error('Data / Hora Início é de preenchimento obrigatório!')
            return false
        }

        if (end == 'Invalid date') {
            alertify.error('Data / Hora Fim é de preenchimento obrigatório!')
            return false
        }

        if (title == '') {
            alertify.error('O que a pessoa irá fazer é de preenchimento obrigatório!')
            return false
        }

        var users = '<select hidden name="audiences[' + count + '][users][]" id="users_audience" multiple aria-hidden="true">'

        var opt = ''

        $('#audiences_users option:selected').each(function() {
            //clona a opcao selecionada
             opt +=  '<option selected value=' + $(this).val() + '></option>';
        });

        users = users + opt + '</select>'

        var td =
            '<td>' +
             users  +
            '<input type="hidden" id="id' + count + '" name="audiences[' + count + '][id]"  value="' + count + '"> ' +
            '<input type="hidden" id="description' + count + '" name="audiences[' + count + '][description]"  value="' + description + '"> ' +

            '<input class="form-control" type="text" readonly id="title' + count + '" name="audiences[' + count + '][title]"  value="' + title + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly id="start' + count + '" name="audiences[' + count + '][start]"  value="' + start + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly  id="end' + count + '" name="audiences[' + count + '][end]"  value="' + end + '"> ' +
            '</td>' +

            '<td>' +
            '<a rel="' + count + '" class="badge bg-yellow" href="javascript:;" onclick="editDetailEvent(this)" >Editar</a>' +

            '<a rel="' + count + '" class="badge bg-danger" href="javascript:;" onclick="removeDetailEvent(this)">Excluir</a>' +
            '</td>';


        if (id != '') {
            $('#audiences_table').find('.j_list').find('#audiences' + id).html(td);

        } else if (id == '') {
            var novo = '<tr id="audiences' + count + '" data-id ="' + count + '">' + td + '</tr>'

            $('#audiences_table').append(novo);

            count--;
        }

        $('#modalAudience').modal('hide');
    })

    $('#audiences_start').change(function () {
        let start = moment($(this).val()).add(1, 'hours').format('DD/MM/YYYY HH:mm:ss')
        let end = moment(start, "DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DDTHH:mm:ss")
        $('#audiences_end').val(end)
    })


})
