@extends('adminlte::page')

@section('title_postfix', '- Google Agenda')

@section('adminlte_css')
    <link href='{{ asset('assets/fullcalendar/lib/main.min.css') }}' rel='stylesheet'/>
    <link href='{{ asset('assets/fullcalendar/css/style.css') }}' rel='stylesheet'/>
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop



@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                               'breadcrumbs' => [
                                               'Google Agenda', ]
                                              ])
@stop



@section('content')

    @include('tenants.includes.alerts')

    @include('tenants.fullcalendar.modal-calendar')

    <div class="card">
        <div class="card-header">
            Google Agenda
        </div>

        <div class="card-body">
            <div id='wrap'>
                <div id='calendar-wrap'>
                    <div id='loading'>loading...</div>

                    <div id='calendar'></div>

                </div>
            </div>
        </div>
    </div>
@stop


@section('js')
    <script src='{{ asset('assets/fullcalendar/lib/main.min.js') }}'></script>
    <script src='{{ asset('assets/fullcalendar/lib/locales/pt-br.js') }}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listYear'
                },

                displayEventTime: false,

                locale: 'pt-br',

                googleCalendarApiKey: '{{ auth()->user()->google_calendar_api_key }}',

                // US Holidays
                events: '{{ auth()->user()->google_calendar_id }}',

                eventClick: function(arg) {
                    window.open(arg.event.url, 'google-calendar-event', 'width=700,height=600');

                    arg.jsEvent.preventDefault()
                },

                loading: function(bool) {
                    document.getElementById('loading').style.display =
                        bool ? 'block' : 'none';
                }

            });

            calendar.render();
        });

    </script>
@stop
