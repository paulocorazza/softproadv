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
    $('#process_id').val(null).trigger('change');
    $('#process_category').val('Outros').trigger('change');
    $('#progress_date').val('');
    $('#progress_description').val('');
    $('#progress_date_term').val('');
    $('#progress_publication').val('');
    $('#progress_concluded').prop("checked", false);
    endPreloader()
}


$('#process_id').select2({
    theme: "classic",
    allowClear: true,
    placeholder: 'Pesquisar por Nº do Processo, Nome ou CPF do cliente',

    ajax: {
        delay: 250,
        type: 'get',
        url: routeProcessAjax,

        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },

        dataType: 'json',
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.process,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

function ajaxSubmitProgress(dados, urlAjax) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        processData: false,
        contentType: false,
        url: urlAjax,
        data: dados,
        beforeSend: startPreloader()
    }).done(function (data) {
        if (data == 1) {
            getProgress(1)
            endPreloader()
            $('#modalProgress').modal('hide');
        } else {
            $('.alert-warning').fadeIn();
            $('#warning').html(data);
            $('html,body').scrollTop(0);
            endPreloader()
        }

    }).fail(function () {
        alertify.alert('Ocorreu um erro na requisição.');
        endPreloader()
    });
}

function editDetailProgress(obj) {
    limparAndamento()
    //ajax para buscar o progresso
    id = $(obj).attr('data-id');

    $('#id_progress').val(id);

    $.ajax({
        method: 'GET',
        processData: false,
        contentType: false,
        url: url_base + '/progresses/' + id,
        beforeSend: startPreloader()
    }).done(function (data) {
        $('#progress_date').val(data.date);
        $('#progress_description').val(data.description);
        $('#progress_date_term').val(data.date_term);
        $('#progress_publication').val(data.publication);
        $('#process_category').val(data.category);

        let process = {
            id: data.process_id,
            text: data.process.number_process + ' - ' +  data.process.person.name
        };

        var newOption = new Option(process.text, process.id, false, false);

        $('#process_id').append(newOption);
        $('#process_id').val(data.process_id)
        $('#process_id').trigger('change');

        let concluded = (data.concluded == '0' ? false : true)
        $('#progress_concluded').prop("checked", concluded);

        endPreloader()
    }).fail(function () {
        alertify.alert('Ocorreu um erro na requisição.');
        endPreloader()
    });
}

function startPreloader() {
    $('#btnSaveUpdateProgress').attr("disabled", true);
    $('.preload .form_load').fadeIn()
}

function endPreloader() {
    $('#btnSaveUpdateProgress').attr("disabled", false);
    $('.preload .form_load').fadeOut();
}


$(document).ready(function () {

    $('#btnProgress').on('click', function () {
        limparAndamento();
        $('#id_progress').val('');
    })


    $('#btnSaveUpdateProgress').on('click', function (e) {
        e.preventDefault();

        var process_id = $('#process_id').val()
        var date = moment($('#progress_date').val()).format("DD/MM/YYYY")
        var description = $('#progress_description').val();
        var date_term =  moment($('#progress_date_term').val()).format("DD/MM/YYYY")
        var publication = $('#progress_publication').val();
        var concluded = ($("#progress_concluded").prop('checked') == true) ? "checked" : '';
        var category =   $('#process_category').val();

        if (process_id == '') {
            alertify.error('Processo é de preenchimento obrigatório!')
            return false
        }

        if (date == 'Invalid date') {
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


        let dados = new FormData()
        dados.append('process_id', process_id)
        dados.append('category', category)
        dados.append('date', date)
        dados.append('description', description)

        if (date_term !== 'Invalid date') {
            dados.append('date_term', date_term)
        }
        dados.append('publication', publication)
        dados.append('concluded', concluded)

        let id_progress = $('#id_progress').val()
        let routeProcessPut = url_base + '/progresses/' + id_progress

        let route = (id_progress === '') ? routeProcessPost  : routeProcessPut

        ajaxSubmitProgress(dados, route)
    })

})
