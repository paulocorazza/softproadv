jQuery.validator.addMethod("requiredCpfIf", function (value, element) {
    var type = $("#type").val()
    if (type == 'U' && value != '') {
        return true
    } else if (type == 'U' && value == '')  {
        return false
    } else {
        return true
    }

}, "Este campo é requerido se Tipo for Usuário")

jQuery.validator.addMethod("requiredOABIf", function (value, element) {
    var type = $("#type").val()
    if (type == 'A' && value != '') {
        return true
    } else if (type == 'A' && value == '')  {
        return false
    } else {
        return true
    }

}, "Este campo é requerido se Tipo for Advogado")


$(document).ready(function () {
    $("#cellphone").mask("(00) 0 0000-0009");
    $("#telephone").mask("(00) 0000-00009");
    $("#cep").mask("00000-000");
    $("#cpf").mask('000.000.000-00', {reverse: true});
    $("#cnpj").mask('00.000.000/0000-00', {reverse: true});
    $("#salary").mask('##.##0,00', {reverse: true});

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


                oab: {
                    maxlength: 8,
                    number: true,
                    requiredOABIf : true
                },

                email: {
                    required: true,
                    email: true,
                    minlength: 3,
                    maxlength: 100
                },

                marital_status: {
                    required: true
                },

                password: {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
                },


                password_confirmation: {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
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
                if ($('.modal.show').length == 0)
                    form.submit();
            }
        })

    });


    $('#type').select2({
        theme: "classic"
    });

    $('#marital_status').select2({
        theme: "classic"
    });

});
