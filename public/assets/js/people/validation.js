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

                cpf: {
                    required: true,
                    cpfBR: true
                },

                cnpj: {
                      cnpjBR: true
                },


                email: {
                    required: true,
                    email: true,
                    minlength: 3,
                    maxlength: 100
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
