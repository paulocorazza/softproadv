@extends('adminlte::page')

@section('title', 'SoftPro - Advogados')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalProcesses }}</h3>

                    <p>Processos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalPeople }}</h3>

                    <p>Clientes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalAdvogados }}</h3>

                    <p>Advogados</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalEvents }}</h3>

                    <p>Atividades Pendentes</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card" id="tabela_progress">
                @include('tenants.home._partials.progress')
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card" id="tabela_events">
                @include('tenants.home._partials.events')
            </div>
        </div>
    </div>


@stop


@section('js')
    <script type="text/javascript" src={{ asset('assets/js/events/finish.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/home/home.js') }}></script>
@stop



