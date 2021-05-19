$(document).ready(function () {
    $("#telephone").mask("(00) 0000-00009");
    $("#cep").mask("00000-000");
    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
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

    $('#estado').select2({
        theme: "classic"
    });

});
