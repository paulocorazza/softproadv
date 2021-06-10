$(document).ready(function () {
    $('.money').mask('#.##0,00', {reverse: true});

    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                financial_category_id: {
                    required: true,
                },

                financial_account_id: {
                  required: true,
                },

                person_id: {
                    required: true,
                },

                document: {
                    required: true,
                },

                original_value: {
                    required: true,
                },

                competence: {
                    required: true,
                },


                due_date: {
                    required: true,
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
                    paymentAmount()

                    var dados = new FormData(form);
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

    $('#type').select2({
        theme: "classic"
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function ajaxSumit(dados, urlAjax) {
        $.ajax({
            method: 'POST',
            processData: false,
            contentType: false,
            url: urlAjax,
            data: dados,
            beforeSend: startPreloader()
        }).done(function (data) {
            if (data == 1) {
                window.location.href = "/financial"
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


    $('#financial_category_id').select2({
        theme: "classic",
        allowClear: true,
        placeholder: 'Selecione a Categoria Financeira',

        ajax: {
            delay: 250,
            type: 'post',
            url: url_base + '/financial-category/search',

            data: function (params) {
                return {
                    q: $.trim(params.term),
                    type: $('#type').val() === 'Pagar' ? 'Despesa' : 'Receita'
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
    $('#financial_account_id').select2({
        theme: "classic",
        allowClear: true,
        placeholder: 'Selecione a Conta Financeira',

        ajax: {
            delay: 250,
            type: 'post',
            url: url_base + '/financial-account/search',

            data: function (params) {
                return {
                    q: $.trim(params.term),
                };
            },

            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.description,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
    $('#person_id').select2({
        theme: "classic",
        allowClear: true,
        placeholder: 'Selecione a Pessoa',

        ajax: {
            delay: 250,
            type: 'post',
            url: url_base + '/people/search',

            data: function (params) {
                return {
                    q: $.trim(params.term),
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

    $('#process_id').select2({
        theme: "classic",
        allowClear: true,
        placeholder: 'Selecione o Processo',

        ajax: {
            delay: 250,
            type: 'get',
            url: url_base + '/process/search',

            data: function (params) {
                return {
                    q: $.trim(params.term),
                    person_id: $('#person_id').val()
                };
            },

            dataType: 'json',
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.number_process,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('#original_value, #discount, #fine, #rate, #credit').change(function () {
        $('#payment_amount').val(paymentAmount()).mask('#.##0,00', {reverse: true});
    })


    function formatNumber(value) {
        if (value != 0) {
            return parseFloat(value.replace('.', '').replace(',', '.'));
        }

        return 0
    }

    function paymentAmount() {
        let original = $('#original_value').val() !== '' ? $('#original_value').val() : 0
        let discount = $('#discount').val() !== '' ? $('#discount').val() : 0
        let fine = $('#fine').val() !== '' ?  $('#fine').val() : 0
        let rate = $('#rate').val() !== '' ? $('#rate').val() : 0
       // let credit = $('#credit').val() !== '' ? $('#credit').val() : 0


        let payment_amount = formatNumber(original) -
                             formatNumber(discount) +
                             formatNumber(fine) +
                             formatNumber(rate)
                            // formatNumber(credit)

        return payment_amount.toLocaleString('pt-br', {minimumFractionDigits: 2});
    }
});
