@extends('adminlte::page')

@section('title', 'SoftPro - Advogados')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_top_nav_right')
    <li class="nav-item" style="margin-right: 5px">
        <a id="btnProgress" data-toggle="modal" data-target=".modal-progress" href="{{ route('events.create') }}"
           class="nav-link btn bg-blue float-right"><i
                class="fas fa-plus"></i> Andamentos</a>

    </li>

    <li class="nav-item">
        <a id="btnAudience" href="{{ route('events.create') }}" data-toggle="modal" data-target=".modal-audience"
           class="nav-link btn bg-blue float-right"><i
                class="fas fa-plus"></i> Audiências</a>
    </li>
@stop

@section('content')
    <div id="modalProgress" class="modal fade modal-progress" tabindex="-1" role="dialog"
         aria-labelledby="modalLarge" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <div>
                        <h4 class="modal-title" id="modalLarge">Andamento </h4>
                    </div>

                    <div>
                        <button id="btnSaveUpdateProgress" type="button" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        <div class="preload">
                            @include('tenants.includes.load')

                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    @include('tenants.processes.partials.formProgress')
                </div>
            </div>
        </div>
    </div>

    <div id="modalAudience" class="modal fade modal-audience" style="overflow:hidden" role="dialog"
         aria-labelledby="modalLarge" aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <div>
                        <h4 class="modal-title" id="modalLarge">Audiência </h4>
                    </div>

                    <div>
                        <button id="btnSaveUpdateAudience" type="button" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        <div class="preload">
                            @include('tenants.includes.load')
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    @include('tenants.processes.partials.formAudience')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-12">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card" id="tabela_progress">
                        @include('tenants.home._partials.progress')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-12">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card" id="tabela_audience">
                        @include('tenants.home._partials.audiences')
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card" id="tabela_events">
                        @include('tenants.home._partials.events')
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')
    <script>
        var routeProcessAjax = "{{ route('processes.select') }}"
        var routeProcessPost = "{{ route('progresses.store') }}"
        var routeAudiencePost = "{{ route('events.store') }}"
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>

    <script type="text/javascript" src={{ asset('assets/js/events/finish.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/home/home.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/home/dashboard.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/home/progress.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/home/event.js') }}></script>
@stop



