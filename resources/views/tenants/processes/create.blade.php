@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <style type="text/css">
        .table td, .table th {
            padding: 0.30rem;
        }
    </style>
@stop


@section('title_postfix', ' - Cadastrar Processos')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Processos',
                               'breadcrumbs' => [
                               'Processos' => route('processes.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    @if( isset($data) )
        {!! Form::model($data, ['route' => ['processes.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister' ]) !!}
    @else
        {!! Form::open(['route' => 'processes.store', 'class' => 'form', 'id' => 'formRegister']) !!}
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Identificação
                        <small> do Processo</small>
                    </h3>
                    <!-- tools box -->
                @include('tenants.includes.toolsBox')
                <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pad">
                    @include('tenants.processes.partials.formIdentificacao')
                </div>
                <!-- /.card-body -->
            </div>
        </div>


        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Informações
                        <small>do Processo</small>
                    </h3>
                    <!-- tools box -->
                @include('tenants.includes.toolsBox')
                <!-- /. tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body pad">
                    @include('tenants.processes.partials.formInformacoes')
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>


    <!-- /.Andamentos -->
    <div class="card card-outline card-blue">
        <div class="card-header">
            <h3 class="card-title">
                Andamentos
                <small>do Processo</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <button id="btnProgress" type="button" class="btn btn-primary" data-toggle="modal"
                    data-target=".modal-progress">Adicionar
            </button>
            <br>
            <br>

            <div id="modalProgress" class="modal fade modal-progress" tabindex="-1" role="dialog"
                 aria-labelledby="modalLarge" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLarge">Andamento</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                @include('tenants.processes.partials.formProgress')
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                            <button id="btnSaveUpdateProgress" type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @include('tenants.includes.load')
                @include('tenants.processes.partials.table-progress')
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.Andamentos -->



    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop


@section('js')
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>

    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/processes/progress.js') }}></script>

    <script type="text/javascript" src={{ asset('assets/js/processes/validation.js') }}></script>
@stop


