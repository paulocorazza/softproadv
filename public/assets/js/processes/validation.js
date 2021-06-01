$(document).ready(function () {
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

    $('.money').mask('#.##0,00', {reverse: true});

    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                person_id: {
                    required: true,
                },

                counterpart_id: {
                    required: true,
                },

                forum_id: {
                    required: true,
                },


                stick_id: {
                    required: true,
                },

                district_id: {
                    required: true,
                },

                group_action_id: {
                    required: true,
                },

                type_action_id: {
                    required: true,
                },

                phase_id: {
                    required: true,
                },

                stage_id: {
                    required: true,
                },

                number_process: {
                    required: true,
                },

                users: {
                    required: true
                },
            },


            errorPlacement: function (error, element) {
                error.insertBefore(element);
            },


            highlight: function (element, errorClass, validClass) {
                $(element).addClass(errorClass).removeClass(validClass);
                $(element.form).find("label[for=" + element.id + "]")
                    .addClass(errorClass);
            },

            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass(errorClass).addClass(validClass);

                $(element.form).find("label[for=" + element.id + "]")
                    .removeClass(errorClass);

            },

            submitHandler: function (form) {
                //if (validateFiles()) {
               //     form.submit();
               // }


                if ($('.modal.show').length == 0) {
                   // var dados = $(form).serialize();
                     var dados = new FormData(form);


                    var _method = $('#formRegister').find('input[name="_method"]').val()


                    if (_method == undefined) {
                        ajaxSumit(dados, submitAjax)
                    } else if (_method == 'PUT') {
                       ajaxSumit(dados, submitAjaxPut)
                    }

                    return false
                }


            }
        })

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function ajaxSumit(dados, urlAjax) {
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
                window.location.href = "/processes"
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



    $('#counterpart_id').select2({
        theme: "classic",
        allowClear: true,
        placeholder: 'Selecione a Parte Contrária',

        ajax: {
            delay: 250,
            type: 'post',
            url: url_base + '/people/search',

            data: function (params) {
                return {
                    q: $.trim(params.term),
                    id: $('#person_id').val()
                };
            },

            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#forum_id').select2({
        placeholder: "Selecione o Fórum",
        allowClear: true,
        theme: "classic",
    })

    $('#stick_id').select2({
        placeholder: "Selecione a Vara",
        allowClear: true,
        theme: "classic",
    })

    $('#district_id').select2({
        placeholder: "Selecione a Comarca",
        allowClear: true,
        theme: "classic",
    })

    $('#group_action_id').select2({
        placeholder: "Selecione o Grupo de Ação",
        allowClear: true,
        theme: "classic",
    })

    $('#group_action_id').on("change", function (e) {
        var id = $(this).val();

        if (id != null || id != '') {

            $('#type_action_id').val(null).trigger('change');
            $("#type_action_id").empty();

            $.ajax({
                url: '/group-actions/' + id + '/type-actions',
                type: 'GET',
                dataType: 'json',

                beforeSend: function () {
                    $('.jloadTypeAction').find('.form_load').css('display', 'flex')
                },

                success: function (data) {
                    $('.jloadTypeAction').find('.form_load').fadeOut(500);
                    var typeActions = $.map(data, function (item) {
                        return new Option(item.name, item.id, false, false)
                    })


                    $('#type_action_id').append(typeActions);
                    $('#type_action_id').trigger('change');
                },

                error: function () {
                    $('.jloadTypeAction').find('.form_load').fadeOut(500);
                }
            });
        }
    });


    $('#type_action_id').select2({
        placeholder: "Selecione o Tipo de Ação",
        allowClear: true,
        theme: "classic",
    })


    $('#type_action_id').on("change", function (e) {
        var idType = $(this).val();

        if (idType != null && idType != '') {

            $('#phase_id').val(null).trigger('change');
            $("#phase_id").empty();

            $.ajax({
                url: '/type-actions/' + idType + '/phasesSelect',
                type: 'GET',
                dataType: 'json',

                beforeSend: function () {
                    $('.jloadPhase').find('.form_load').css('display', 'flex')
                },

                success: function (data) {
                    $('.jloadPhase').find('.form_load').fadeOut(500);
                    var phases = $.map(data, function (item) {
                        return new Option(item.name, item.id, false, false)

                    })

                    $('#phase_id').append(phases);
                    $('#phase_id').trigger('change');
                },

                error: function () {
                    $('.jloadPhase').find('.form_load').fadeOut(500);
                }
            });
        }
    });

    $('#phase_id').on("change", function (e) {
        var idPhase = $(this).val();

        if (idPhase != null && idPhase != '') {

            $('#stage_id').val(null).trigger('change');
            $("#stage_id").empty();

            $.ajax({
                url: '/phases/' + idPhase + '/stagesSelect',
                type: 'GET',
                dataType: 'json',

                beforeSend: function () {
                    $('.jloadStage').find('.form_load').css('display', 'flex')
                },

                success: function (data) {
                    console.log(data)

                    $('.jloadStage').find('.form_load').fadeOut(500);
                    var stages = $.map(data, function (item) {
                        return new Option(item.name, item.id, false, false)

                    })

                    $('#stage_id').append(stages);
                    $('#stage_id').trigger('change');
                },

                error: function () {
                    $('.jloadStage').find('.form_load').fadeOut(500);
                }
            });
        }
    });


    $('#phase_id').select2({
        placeholder: "Selecione a Fase",
        allowClear: true,
        theme: "classic",
    })

    $('#stage_id').select2({
        placeholder: "Selecione a Etapa",
        allowClear: true,
        theme: "classic",
    })

    $('#users').select2({
        allowClear: true,
        theme: "classic",
    })

    $('#status').select2({
        allowClear: true,
        theme: "classic",
    })

    //deleta registro mestre
    $('.j_delete').on('click', function (e) {
        e.preventDefault();

        reset();

        alertify.confirm("Deseja excluir o registro selecionado?", function (e) {
            if (e) {
                $('#formDelete').submit();
            }

        })
    })

});
