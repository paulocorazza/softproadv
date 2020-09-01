$(function () {

    $('.date-time').mask('00/00/0000 00:00:00');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


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
        let start = moment($('#modalCalendar #start').val(), "DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DD HH:mm:ss")
        let end = moment($('#modalCalendar #end').val(), "DD/MM/YYYY HH:mm:ss").format("YYYY-MM-DD HH:mm:ss")
        let color =  $('#modalCalendar #color').val()
        let description =  $('#modalCalendar #description').val()
        let process_id = $('#modalCalendar #process_id').val()
        let users = $('#modalCalendar #users').val()


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
    $('.select').prop('selectedIndex',-1).trigger( "change" );
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

/*$('#user-select').change(function(){
  // objCalendar.removeEvents ;//remove os eventos anteriores

    var user_id=$('#user-select option:selected').val();//Pega o id do option

    var data_ = {
        'user_id' : user_id,
        'start' : objCalendar.da
   }

   console.log(data_)

    $.ajax({
        type:"GET",
        dataType: 'json',
        data : data_,

        url: routeEvents('routeLoadEvents'),

        success: function(data){
            console.log(data)
            $.each(data,function(index,value){//Para cada valor do data, compara se o campo é igual ao filtro selecionado. Se for igual, renderiza.
            console.log(value)
                if(value.user_id ==user_id){
                   // $("#calendar").fullCalendar('renderEvent', value, true);
                    objCalendar.refetchEvents()
                }
            })
        }
    });
});*/



/*$('#user-select').change(function() {

    objCalendar.extraParams  = {
        'user_id' : userSelect()
    }

    objCalendar.refetchEvents()

})*/


/*$('#btnSubmit').click(function (e) {
    e.preventDefault();


    let user_id = $('#userselect option:selected').val();

    let data_ = {
        'user_id' : user_id,
        'start' : objCalendar.getDate()
    }

    console.log(data_)



    $.ajax({
        type:"GET",
        dataType: 'json',
        data : data_,

        url: routeEvents('routeLoadEvents'),

        success: function(data){
            console.log(data)
            events = data
        }
    });

})*/

function userSelect() {
    return $('#user-select option:selected').val();
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

