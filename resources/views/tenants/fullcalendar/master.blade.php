@extends('adminlte::page')

@section('title_postfix', '- Agenda')

@section('css')
    <link href='{{ asset('assets/fullcalendar/lib/main.min.css') }}' rel='stylesheet'/>
    <link href='{{ asset('assets/fullcalendar/css/style.css') }}' rel='stylesheet'/>
@stop



@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                               'breadcrumbs' => [
                                               'Agenda', ]
                                              ])
@stop



@section('content')

    @include('tenants.includes.alerts')

    @include('tenants.fullcalendar.modal-calendar')

    <div id='wrap'>
        <div id='external-events'>
            <h4>Atividades</h4>

            <div id='external-events-list'>
                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                    <div class='fc-event-main'>My Event 1</div>
                </div>
                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                    <div class='fc-event-main'>My Event 2</div>
                </div>
                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                    <div class='fc-event-main'>My Event 3</div>
                </div>
                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                    <div class='fc-event-main'>My Event 4</div>
                </div>
                <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
                    <div class='fc-event-main'>My Event 5</div>
                </div>
            </div>

            <p>
                <input type='checkbox' id='drop-remove'/>
                <label for='drop-remove'>Remover atividades agendadas</label>
            </p>
        </div>


        <div id='calendar-wrap'>
            <div
                id='calendar'
                data-route-load-events="{{ route('routeLoadEvents') }}"
                data-route-event-update="{{ route('routeEventUpdate') }}"
            >

            </div>
        </div>

    </div>
@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script src='{{ asset('assets/fullcalendar/lib/main.min.js') }}'></script>
    <script src='{{ asset('assets/fullcalendar/lib/locales/pt-br.js') }}'></script>
    <script src='{{ asset('assets/fullcalendar/js/script.js') }}'></script>
    <script src='{{ asset('assets/fullcalendar/js/calendar.js') }}'></script>

@stop
