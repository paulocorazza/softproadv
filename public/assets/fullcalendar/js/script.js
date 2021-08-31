$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#modalCalendar #start').change(function () {
        let start = moment($(this).val()).add(1, 'hours').format('DD/MM/YYYY HH:mm:ss')
        let end = moment(start, "DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DDTHH:mm:ss")
        $('#modalCalendar #end').val(end)
    })



    $('.deleteEvent').click(function () {

        let id =  $('#modalCalendar #id').val()
        let Event = {
            id: id,
            _method: 'DELETE'
        }
        let route = routeEvents('routeEventDelete');
        sendEvent(route, Event)
    })

    $('.saveEvent').click(function () {
        let id =  $('#modalCalendar #id').val()
        let title = $('#modalCalendar #title').val()

        let start =  moment($('#modalCalendar #start').val()).format("YYYY/MM/DD HH:mm:ss")
        let end =  moment($('#modalCalendar #end').val()).format("YYYY/MM/DD HH:mm:ss")

        let color =  $('#modalCalendar #color').val()
        let description =  $('#modalCalendar #description').val()
        let process_id = $('#modalCalendar #process_id').val()
        let users = $('#modalCalendar #users').val()


        if (users.length === 0) {
            alertify.alert('Informe um advogado para o evento!')
            return
        }

        if (title === '') {
            alertify.alert('Informe um título para o evento!')
            return
        }


        let Event = {
            title: title,
            start: start,
            end: end,
            color: color,
            description: description,
            process_id: process_id,
            users: users
        }

        let route;


        if (id == '') {
            route = routeEvents('routeEventStore')
        } else {
            route = routeEvents('routeEventUpdate')
            Event.id = id
            Event._method = 'PUT'
        }

        sendEvent(route, Event);
    })

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
            //  location.reload()
                objCalendar.refetchEvents()

               if ($('.modal:visible').length && $('body').hasClass('modal-open')) {
                   $('#modalCalendar').modal('hide')
               }
            }
       },

        error: function (json) {
            let responseJSON = json.responseJSON.errors;

            $('#message').html(loadErrors(responseJSON))
        }
    });
}
function clearMessage(element) {
    $(element).text('')
}

function resetForm(form) {
    return $(form)[0].reset();
}

function loadErrors(response) {
    let boxAlert = `<div class="alert alert-danger">`;

    for (let fields in response) {
        boxAlert += `<span>${response[fields]}</span><br/>`
    }

    boxAlert += `</div>`

    return boxAlert.replace(',', '<br>')
}


$('#userselect').change(function() {

    let user_id = $('#userselect option:selected').val();

    let data_ = {
        'user_id' : user_id
    }

    $.ajax({

        url: routeEvents('routeLoadUser'),
        type:"GET",
        dataType: 'json',
        data : data_,

        beforeSend: function () {
            startPreloader()
        },

        success: function(data){
            objCalendar.refetchEvents()
            endPreloader()
        }
    });
})

function startPreloader() {
    $('.preload .form_load').fadeIn()
}

function endPreloader() {
    $('.preload .form_load').fadeOut();
}

$('.select').select2({
    allowClear: true,
    theme: "classic",
})



$('#process_id').select2({
    theme: "classic",
    allowClear: true,
    placeholder: 'Pesquisar por Nome ou CPF do cliente',

    ajax: {
        delay: 250,
        type: 'get',
        url: routeEvents('routeEventProcess'),

        data: function (params) {
            return {
                q: $.trim(params.term)
            };
        },

        dataType: 'json',
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {

                    return {
                        text: item.process,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});

