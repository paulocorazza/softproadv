$(document).ready(function () {

    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                description: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },

                contract : {
                    required: true
                }
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
                $('input[type=submit]').prop('disabled', true);
            }
        })

    });

});
