$(document).ready(function () {
    $('.money').mask('#.##0,00', {reverse: true});
    $("#cep").mask("00000-000");
    $("#cnpj").mask('00.000.000/0000-00', {reverse: true});

    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                description: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
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
                $('input[type=submit]').prop('disabled', true);
            }
        })

    });
});
