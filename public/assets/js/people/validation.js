jQuery.validator.addMethod("requiredCpfIf", function (value, element) {
    var type = $("#type").val()
    if (type == 'F' && value != '') {
        return true
    } else if (type == 'F' && value == '')  {
        return false
    } else {
            return true
    }

}, "Este campo é requerido se Tipo for Pessoa Física")

jQuery.validator.addMethod("requiredCnpjIf", function (value, element) {
    var type = $("#type").val()
    if (type == 'J' && value != '') {
        return true
    } else if (type == 'J' && value == '')  {
        return false
    } else {
        return true
    }

}, "Este campo é requerido se Tipo for Pessoa Jurídica")

$(document).ready(function () {
    $("#cellphone").mask("(00) 0000-00009");
    $("#telephone").mask("(00) 0000-00009");
    $("#cep").mask("00000-000");
    $("#cpf").mask('000.000.000-00', {reverse: true});
    $("#cnpj").mask('00.000.000/0000-00', {reverse: true});

    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },

                fantasy: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },

                type: {
                    required: true
                },


                cpf: {
                    cpfBR: true,
                    requiredCpfIf: true
                },

                cnpj: {
                    cnpjBR: true,
                    requiredCnpjIf : true
                },


                marital_status: {
                    required: true
                },

                email: {
                    required: true,
                    email: true,
                    minlength: 3,
                    maxlength: 100
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
                form.submit();
            }
        })

    });


    $('#type').select2({
        placeholder: "Selecione o tipo da pessoa",
        allowClear: true,
        theme: "classic"
    });

    $('#marital_status').select2({
        placeholder: "Selecione o estado civil",
        allowClear: true,
        theme: "classic"
    });

    $('#origin_id').select2({
        placeholder: "Selecione uma origem",
        allowClear: true,
        theme: "classic"
    });

});