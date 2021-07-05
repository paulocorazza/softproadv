@extends('adminlte::page')

@section('title', 'SoftPro - Advogados')

@section('adminlte_css')
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@stop

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$totalInProgress}} / {{ $totalProcesses }}</h3>

                            <p>Processos em andamento</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>

                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalEvents }}<sup style="font-size: 20px">%</sup></h3>

                            <p>Atividades Concluídas</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="card" id="tabela_progress">
                        @include('tenants.home._partials.progress')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <!-- ./col -->
            <div class="row">
                @include('tenants.home._partials.financialChart')
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
    {!! $financialChart->script()  !!}
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <script src=" {{ asset('vendor/chart.js/Chart.min.js') }} "></script>

    <script type="text/javascript" src={{ asset('assets/js/events/finish.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/home/home.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/home/dashboard.js') }}></script>
@stop



