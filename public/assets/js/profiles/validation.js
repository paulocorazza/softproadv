$(document).ready(function () {

    $('#formRegister').each(function () {
        $(this).validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                    maxlength: 60,
                },

                label: {
                    required: true,
                    minlength: 3,
                    maxlength: 200,
                },

            },

            submitHandler: function (form) {
                form.submit();
            }
        })

    });

});
