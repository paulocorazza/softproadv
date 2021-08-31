document.addEventListener('DOMContentLoaded', function () {


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
        droppable: true,

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
            clearMessage('#message')
            resetForm('#formEvent');

            $('#modalCalendar').modal('show')
            $('#modalCalendar #titleModal').text('Alterar Evento');
            $('#modalCalendar button.deleteEvent').addClass('d-inline')

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

            let start = moment(element.event.start, "YYYY-MM-DD HH:mm:ss").format('YYYY-MM-DDTHH:mm:ss')
            $('#modalCalendar #start').val(start)

            let end = moment(element.event.end, "YYYY-MM-DD HH:mm:ss").format('YYYY-MM-DDTHH:mm:ss')
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
            $('#modalCalendar button.deleteEvent').removeClass('d-inline')
            $('#modalCalendar button.deleteEvent').css("display", 'none');
            $('#modalCalendar #id').val('')

            $("#modalCalendar #users").val(null).trigger('change');
            $("#modalCalendar #process_id").val(null).trigger('change');

            let start = moment(element.start, "DD/MM/YYYY HH:mm:ss").format('YYYY-MM-DDTHH:mm:ss')
            $('#modalCalendar #start').val(start)

            let end = moment(element.end, "DD/MM/YYYY HH:mm:ss").format('YYYY-MM-DDTHH:mm:ss')
            $('#modalCalendar #end').val(end)

            let color = '#3788d8';
            $('#modalCalendar #color').val(color)

            calendar.unselect()
        },


        events: routeEvents('routeLoadEvents')

    });

    objCalendar = calendar;

    calendar.render();
});


