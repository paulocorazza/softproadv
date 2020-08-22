$(function () {

    $('.date-time').mask('00/00/0000 00:00:00');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


})


function routeEvents(dataset) {
    // return document.getElementById('calendar').dataset[route];
    return $('#calendar').data(dataset)
}


function sendEvent(route, data_) {
    $.ajax({
       url: route,
       data: data_,
       method: 'POST',
       dataType: 'json',
       success: function (json) {
            if (json) {
              location.reload()
            }
       }
    });
}

function resetForm(form) {
    return $(form)[0].reset();
}


