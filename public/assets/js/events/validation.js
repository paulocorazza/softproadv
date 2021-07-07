$(document).ready(function () {

    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                title: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },

                start: {
                    required: true,
                },

                end: {
                    required: true,
                },

                users: {
                    required: true
                },
            },


            errorPlacement: function(error, element) {
                error.insertBefore(element);
            },


            highlight: function(element, errorClass, validClass) {
                $(element).addClass(errorClass).removeClass(validClass);
                $(element.form).find("label[for=" + element.id + "]")
                    .addClass(errorClass);
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);
                $(element.form).find("label[for=" + element.id + "]")
                    .removeClass(errorClass);
            },

            submitHandler: function (form) {
                    var dados = $(form).serialize();
                    var _method = $('#formRegister').find('input[name="_method"]').val()

                    if (_method == undefined) {
                        ajaxSumit(dados, submitAjax)
                    } else if (_method == 'PUT') {
                        ajaxSumit(dados, submitAjaxPut)
                    }

                    return false
            }
        })

    });



    function ajaxSumit(dados, urlAjax) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST',
            url: urlAjax,
            data: dados,
            beforeSend: startPreloader()
        }).done(function (data) {
            if (data == 1) {
                window.location.href = "/events"
                endPreloader()
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

    function startPreloader() {
        $('input[type=submit]').prop('disabled', true);
        $('.preload .form_load').fadeIn()
    }

    function endPreloader() {
        $('input[type=submit]').prop('disabled', false);
        $('.preload .form_load').fadeOut();
    }


    $('#users').select2({
        allowClear: true,
        theme: "classic",
    })

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

});
