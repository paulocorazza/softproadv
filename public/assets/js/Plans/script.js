function removeDetail(obj)
{
    $(obj).closest('tr').remove();
}


$(document).ready(function () {
    $("#btnKeyPayPal").on('click', function (e) {
        e.preventDefault();

        alert('paypal')
    })

    var count = 0;

    $('#add_details').on('click', function () {
        var detalhe = $('#detail').val();

        var tr =
            '<tr>' +
                '<td>' +
                    '<input class="form-control" type="text" name="details[]" value="' + detalhe + '" >' +
                '</td>' +

                '<td>' +
                    '<a class="btn btn-danger" href="javascript:;" onclick="removeDetail(this)">Excluir</a>' +
                '</td>' +
            '</tr>';

        $('#details_table').append(tr);

        $('#detail').val('').focus();

    })


})
