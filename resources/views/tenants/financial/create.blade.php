@extends('adminlte::page')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('title_postfix', ' - Cadastrar Novo Lançamento Financeiro')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => $title,
                               'breadcrumbs' => [
                               'Financeiro' => route('financial.index'),
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
        {!! Form::model($data, ['route' => ['financial.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
    @else
        {!! Form::open(['route' => 'financial.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
    @endif

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>do Lançamento</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.financial.partials.formIdentificacao')
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-outline card-blue">
        <div class="card-header">
            <h3 class="card-title">
                Dados Financeiros
                <small>do Lançamento</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.financial.partials.formValores')
        </div>
        <!-- /.card-body -->
    </div>

    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

    <br />
    <br />
@stop

@section('js')
    <script>
        var submitAjaxPut = "{{ route('financial.update', isset($data->id) ? $data->id : 0 ) }}"
        var submitAjax = "{{ route('financial.store') }}";
    </script>

    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.js') }}"></script>
    <script type="text/javascript" src={{ asset('assets/js/financial/validation.js') }}></script>
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop


