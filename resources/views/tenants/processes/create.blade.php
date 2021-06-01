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
        @include('tenants.includes.breadcrumbs',  ['title' =>  isset($data->id) ? 'Gestão de Processos - ' . $data->number_process : 'Gestão de Processos' ,
                               'breadcrumbs' => [
                               'Processos' => route('processes.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="alert alert-warning" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-exclamation"></i> Atenção!</h4>
        <div id="warning"></div>
    </div>

    @if( isset($data) )
        {!! Form::model($data, ['route' => ['processes.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true]) !!}
    @else
        {!! Form::open(['route' => 'processes.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
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


    <!-- /.Arquivos -->
    <div class="card card-outline card-blue">
        <div class="card-header">
            <h3 class="card-title">
                Arquivos
                <small>do Processo</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <div class="wrapper">
                <div class="toclone">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="files[0][description]" id="file0">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <input type="file" name="files[0][img]" id="img0">
                            </div>
                        </div>

                        <div class="col-2">
                            <button type="button" class="btn bg-primary" onclick="addFile(this)"> + </button>
                            <button type="button" class="btn bg-danger" onclick="removeFile(this)"> - </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Arquivos</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    @include('tenants.processes.partials.table-files')
                </div>
                <!-- /.card-body -->
            </div>

        </div>
    </div>
    <!-- /.Arquivos -->



    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

    <div class="preload">
        @include('tenants.includes.load')
    </div>
@stop


@section('js')
    <script>
        var submitAjaxPut = "{{ route('processes.update', isset($data->id) ? $data->id : 0 ) }}"
        var submitAjax = "{{ route('processes.store') }}";
        var deleteFileAjax = "{{ route('fileDelete') }}";
        var deleteProgressAjax = "{{ route('progressDelete') }}";
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.js') }}"></script>

    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/processes/progress.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/processes/files.js') }}></script>

    <script type="text/javascript" src={{ asset('assets/js/processes/validation.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/people/person-select.js') }}></script>
@stop


