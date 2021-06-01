document.addEventListener('DOMContentLoaded', function () {

    /* initialize the external events
    -----------------------------------------------------------------*/

 /*   var containerEl = document.getElementById('external-events-list');
    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.fc-event',
        eventData: function (eventEl) {
            return {
                title: eventEl.innerText.trim()
            }
        }
    });*/


    /* initialize the calendar
    -----------------------------------------------------------------*/

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        locale: 'pt-br',
        navLinks: true,
        dayMaxEventRows: true,
        selectable: true,
        editable: true,
        droppable: true, // this allows things to be dropped onto the calendar
   /*     drop: function (element) {
            // is the "remove after drop" checkbox checked?
            if (document.getElementById('drop-remove').checked) {
                // if so, remove the element from the "Draggable Events" list
                element.draggedEl.parentNode.removeChild(element.draggedEl);
            }
        },*/

        //arrastar de uma celula para outra
        eventDrop: function (element) {
            let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
            let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");

             let newEvent = {
                _method: 'PUT',
                id: element.event.id,
                title: element.event.title,
                start: start,
                end: end,
                process_id: element.event.extendedProps.process_id,
                user_id: element.event.extendedProps.user_id,
                schedule: element.event.extendedProps.schedule
            };


            sendEvent(routeEvents('routeEventUpdate'), newEvent);

        },

        //ao clicar no evento que já está na celula
        eventClick: function (element) {
            //retornar outros campos
            //console.log(element.event.extendedProps.created_at)

            clearMessage('#message')
            resetForm('#formEvent');

            $('#modalCalendar').modal('show')
            $('#modalCalendar #titleModal').text('Alterar Evento');
            $('#modalCalendar button.deleteEvent').css("display", 'flex');

            let id = element.event.id;
            $('#modalCalendar #id').val(id)

            let users = element.event.extendedProps.users;
            var arr = []
            $.each(users, function(i, obj) {
                arr.push(obj.id)
            });
            $('#modalCalendar #users').val(arr);
            $('#modalCalendar #users').trigger('change');



            if (element.event.extendedProps.process !== null) {
                let process_id = element.event.extendedProps.process.id
                let process_person = element.event.extendedProps.process.process_person

                let process = {
                    id: process_id,
                    text: process_person
                };

                var newOption = new Option(process.text, process.id, false, false);
                $('#process_id').append(newOption).trigger('change');
            }

            let title = element.event.title;
            $('#modalCalendar #title').val(title)

            let start = moment(element.event.start).format("DD/MM/YYYY HH:mm:ss")
            $('#modalCalendar #start').val(start)

            let end = moment(element.event.end).format("DD/MM/YYYY HH:mm:ss")
            $('#modalCalendar #end').val(end)

            let color = element.event.backgroundColor;
            $('#modalCalendar #color').val(color)

            let description = element.event.extendedProps.description;
            $('#modalCalendar #description').val(description)
        },

        //ao redimencionar o tamanho do evento
        eventResize: function (element) {
            let start = moment(element.event.start).format("YYYY-MM-DD HH:mm:ss");
            let end = moment(element.event.end).format("YYYY-MM-DD HH:mm:ss");


            let newEvent = {
                _method: 'PUT',
                id: element.event.id,
                title: element.event.title,
                start: start,
                end: end,
                process_id: element.event.extendedProps.process_id,
                user_id: element.event.extendedProps.user_id,
                schedule: element.event.extendedProps.schedule
            };

            sendEvent(routeEvents('routeEventUpdate'), newEvent);
        },

        //ao selecionar uma celula
        select: function (element) {
            clearMessage('#message')
            resetForm('#formEvent');

            $('#modalCalendar').modal('show')
            $('#modalCalendar #titleModal').text('Adicionar Evento');
            $('#modalCalendar button.deleteEvent').css("display", 'none');
            $('#modalCalendar #id').val('')

            $("#modalCalendar #users").val(null).trigger('change');
            $("#modalCalendar #process_id").val(null).trigger('change');

            let start = moment(element.start).format("DD/MM/YYYY HH:mm:ss")
            $('#modalCalendar #start').val(start)

            let end = moment(element.end).format("DD/MM/YYYY HH:mm:ss")
            $('#modalCalendar #end').val(end)

            let color = '#3788d8';
            $('#modalCalendar #color').val(color)

            calendar.unselect()
        },


     /*   eventReceive: function(element) {
          element.event.remove()
        },*/

        //listar os eventos no calendario
       // events: routeEvents('routeLoadEvents')
      //  events:  url_base + '/schedule/events/?user_id=' + userSelect()

        /*eventSources: [

            // your event source
            {
                url: routeEvents('routeLoadEvents'),
                method: 'GET',
                extraParams: {
                    user_id: userSelect(),
                }
            }]*/


        events: routeEvents('routeLoadEvents')


    });

    objCalendar = calendar;

//    console.log(moment(calendar.currentData).format("YYYY-MM-DD HH:mm:ss"));
//    console.log(moment(calendar.currentData).endOf('month').format("YYYY-MM-DD HH:mm:ss"));


    calendar.render();
});


