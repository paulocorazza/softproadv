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
                end: end
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
                end: end
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
        events: routeEvents('routeLoadEvents')
    });

    objCalendar = calendar;
    calendar.render();
});


