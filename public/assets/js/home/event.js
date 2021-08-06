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
    $('#process_event_id').val(null).trigger('change');
    $('#audiences_users').val("").trigger('change');
    $('#audiences_title').val('');
    $('#audiences_start').val('');
    $('#audiences_end').val('');
    $('#audiences_color').val('');
    $('#audiences_description').val('');
    endPreloader()
}


$('#process_event_id').select2({
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

function ajaxSubmitEvent(dados, urlAjax) {
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
            getAudiences(1)
            endPreloader()
            $('#modalAudience').modal('hide');
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

function editDetailAudience(obj) {
    limparAudience()
    id = $(obj).attr('data-id');

    $('#id_audience').val(id);

    $.ajax({
        method: 'GET',
        processData: false,
        contentType: false,
        url: url_base + '/events/' + id + '/edit',
        beforeSend: startPreloader()
    }).done(function (data) {

        let users = data.users;
        var arr = []
        $.each(users, function(i, obj) {
            arr.push(obj.id)
        });

        $('#audiences_users').val(arr);
        $('#audiences_users').trigger('change');


        $('#audiences_title').val(data.title);
        $('#audiences_start').val(moment(data.start, "YYYY-MM-DD HH:mm:ss").format('YYYY-MM-DDTHH:mm:ss'));
        $('#audiences_end').val(moment(data.end, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DDTHH:mm:ss"));
        $('#audiences_description').val(data.description);

        let process = {
            id: data.process_id,
            text: data.process.number_process + ' - ' +  data.process.person.name
        };

        var newOption = new Option(process.text, process.id, false, false);

        $('#process_event_id').append(newOption);
        $('#process_event_id').val(data.process_id)
        $('#process_event_id').trigger('change');

        endPreloader()
    }).fail(function () {
        alertify.alert('Ocorreu um erro na requisição.');
        endPreloader()
    });
}

function startPreloader() {
    $('#btnSaveUpdateAudience').attr("disabled", true);
    $('.preload .form_load').fadeIn()
}

function endPreloader() {
    $('#btnSaveUpdateAudience').attr("disabled", false);
    $('.preload .form_load').fadeOut();
}


$(document).ready(function () {
    $('#audiences_start').change(function () {
        let start = moment($(this).val()).add(1, 'hours').format('DD/MM/YYYY HH:mm:ss')
        let end = moment(start, "DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DDTHH:mm:ss")
        $('#audiences_end').val(end)
    })


    $('#audiences_users').select2({
        allowClear: true,
        dropdownParent: $('#modalAudience')
    });


    $('#btnAudience').on('click', function () {
        limparAudience();
        $('#id_audience').val('');
    })


    $('#btnSaveUpdateAudience').on('click', function (e) {
        e.preventDefault();

        let users = $('#audiences_users').val()
        let process_id = $('#process_event_id').val()
        let start =  moment($('#audiences_start').val()).format("YYYY/MM/DD HH:mm:ss")
        let end =  moment($('#audiences_end').val()).format("YYYY/MM/DD HH:mm:ss")
        let title = $('#audiences_title').val();
        let description = $('#audiences_description').val();

        if (process_id === '') {
            alertify.error('Processo é de preenchimento obrigatório!')
            return false
        }

        if (users === '') {
            alertify.error('Advogado é de preenchimento obrigatório!')
            return false
        }

        if (start === 'Invalid date') {
            alertify.error('Data / Hora Início é de preenchimento obrigatório!')
            return false
        }

        if (end === 'Invalid date') {
            alertify.error('Data / Hora Fim é de preenchimento obrigatório!')
            return false
        }

        if (title === '') {
            alertify.error('O que a pessoa irá fazer é de preenchimento obrigatório!')
            return false
        }

        let dados = new FormData()
        dados.append('process_id', process_id)
        dados.append('start', start)
        dados.append('end', end)
        dados.append('title', title)
        dados.append('description', description)
        dados.append('color', '#000000')
        dados.append('schedule', 'true')
        dados.append('audience', 'true')
        dados.append('users', users)

        let id_audience = $('#id_audience').val()
        let routeAudiencePut = url_base + '/events/' + id_audience

        if (id_audience === '') {
            ajaxSubmitEvent(dados, routeAudiencePost)
        } else {
            dados.append('_method', 'put')
            ajaxSubmitEvent(dados, routeAudiencePut)
        }



    })

})
