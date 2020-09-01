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

    <div class="card">
        <div class="card-header">
            Agenda
        </div>

        <div class="card-body">
            <div id='wrap'>
                <div id='calendar-wrap'>
                    <form action="{{ route('calendar.index') }}"  method="GET" class="form-inline" name="formFilter">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="userselect" class="sr-only">Advogados</label>
                            <select name="userselect" id="userselect" class="form-control select">
                                <option value="0">Todos Advogados</option>
                                @foreach($users as $key => $value)
                                    <option value="{{ $key }}"
                                            @if (request('userselect') == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" id="btnSubmit" class="btn btn-primary mb-2">Filtrar</button>
                    </form>

                    <div
                        id='calendar'
                        data-route-event-update="{{ route('routeEventUpdate') }}"
                        data-route-event-store="{{ route('routeEventStore') }}"
                        data-route-event-delete="{{ route('routeEventDelete') }}"
                        data-route-event-process="{{ route('processes.select') }}"
                    >
                    </div>
                </div>
            </div>


        </div>
    </div>



@stop


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script src='{{ asset('assets/fullcalendar/lib/main.min.js') }}'></script>
    <script src='{{ asset('assets/fullcalendar/lib/locales/pt-br.js') }}'></script>

    <script>
        let objCalendar;
        events={!! json_encode($events) !!};
    </script>
    <script src='{{ asset('assets/fullcalendar/js/script.js') }}'></script>
    <script src='{{ asset('assets/fullcalendar/js/calendar.js') }}'></script>

@stop
