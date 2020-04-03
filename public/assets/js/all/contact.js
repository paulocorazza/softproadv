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

function limparContato() {
    $('#contact_name').val('');
    $('#contact_email').val('');
    $('#contact_telephone').val('');
    $('#contact_cellphone').val('');
}


function editDetail(obj) {
    limparContato()

    id = $(obj).closest('tr').attr('data-id');
    var name = $('input[type=text][name="contacts[' + id + '][name]"]').val();
    var email = $('input[type=text][name="contacts[' + id + '][email]"]').val();
    var telephone = $('input[type=text][name="contacts[' + id + '][telephone]"]').val();
    var cellphone = $('input[type=text][name="contacts[' + id + '][cellphone]"]').val();


    $('#contact_name').val(name);
    $('#contact_email').val(email);
    $('#contact_telephone').val(telephone);
    $('#contact_cellphone').val(cellphone);

    $('#modalContact').modal('show');
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
                deletaContactAjax(obj, id);
            }
        }
    })
}


function deletaContactAjax(obj, id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: deleteContactAjax,
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
    $("#contact_telephone").mask("(00) 0000-00009");
    $("#contact_cellphone").mask("(00) 0000-00009");

    $('#btnContact').on('click', function () {
        id = ''
        limparContato();
    })


    var count = 0;

    $('#btnSaveUpdateContact').on('click', function (e) {
        e.preventDefault();

        if (id != '')
            count = id

        var contact_name = $('#contact_name').val();
        var contact_email = $('#contact_email').val();
        var contact_telephone = $('#contact_telephone').val();
        var contact_cellphone = $('#contact_cellphone').val();


        if (contact_name == '') {
            alertify.error('Nome de preenchimento obrigatório!')
            return false
        }


        var td =
            '<td>' +
            '<input type="hidden" name="contacts[' + count + '][id]"  value="' + count + '"> ' +

            '<input class="form-control" type="text" readonly name="contacts[' + count + '][name]"  value="' + contact_name + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly name="contacts[' + count + '][telephone]"  value="' + contact_telephone + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly name="contacts[' + count + '][cellphone]"  value="' + contact_cellphone + '"> ' +
            '</td>' +

            '<td>' +
            '<input class="form-control" type="text" readonly name="contacts[' + count + '][email]"  value="' + contact_email + '"> ' +
            '</td>' +


            '<td>' +
            '<a rel="' + count + '" class="badge bg-yellow" href="javascript:;" onclick="editDetail(this)" >Editar</a>' +

            '<a rel="' + count + '" class="badge bg-danger" href="javascript:;" onclick="removeDetail(this)">Excluir</a>' +
            '</td>';

        if (id != '') {
            $('#contact_table').find('.j_list').find('#contacts' + id).html(td);

        } else if (id == '') {
            var novo = '<tr id="contacts' + count + '" data-id ="' + count + '">' + td + '</tr>'

            $('#contact_table').append(novo);

            count--;
        }

        $('#modalContact').modal('hide');
    })

})
