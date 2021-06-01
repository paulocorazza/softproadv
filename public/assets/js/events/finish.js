function finishEvent(eventId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'POST',
        url: '/events/finish',
        data: {
            'event' : eventId,
        }

    }).done(function (data) {


    }).fail(function () {
        alertify.alert('Ocorreu um erro na requisição.');
    });
}
