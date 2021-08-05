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
    $('#progress_concluded').val('');
}


function editDetail(obj) {
    limparAndamento()

    //ajax para buscar o progresso


    $('#progress_date').val(moment(created, "DD/MM/YYYY").format("YYYY-MM-DD"));
    $('#progress_description').val(description);
    $('#progress_date_term').val(moment(dateTerm, "DD/MM/YYYY").format("YYYY-MM-DD"));
    $('#progress_publication').val(publication);

    $('#progress_concluded').prop("checked", concluded);

    $('#modalProgress').modal('show');
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



$(document).ready(function () {
    function ajaxSubmit(dados, urlAjax) {
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
                window.location.href = "/home"
                endPreloader()
                return true
            } else {
                $('.alert-warning').fadeIn();
                $('#warning').html(data);
                $('html,body').scrollTop(0);
                endPreloader()
                return false
            }

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

    $('#btnProgress').on('click', function () {
        limparAndamento();
    })


    $('#btnSaveUpdateProgress').on('click', function (e) {
        e.preventDefault();

        var process_id = $('#process_id').val()
        var date = moment($('#progress_date').val()).format("YYYY-MM-DD")
        var description = $('#progress_description').val();
        var date_term =  moment($('#progress_date_term').val()).format("YYYY-MM-DD")
        var publication = $('#progress_publication').val();
        var concluded = ($("#progress_concluded").prop('checked') == true) ? "checked" : '';


        if (process_id == '') {
            alertify.error('Processo é de preenchimento obrigatório!')
            return false
        }

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

        dados = {
            'process_id' : process_id,
            'date' : date,
            'description' : description,
            'date_term' : date_term,
            'publication' :  publication,
            'concluded' : concluded
        }

        //ajax para salvar o progresso
        if (ajaxSubmit(dados, '')) {
            $('#modalProgress').modal('hide');
        }
    })

})
