@extends('adminlte::page')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('title_postfix', ' - Cadastrar Nova Conta Financeira')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => $title,
                               'breadcrumbs' => [
                               'Conta Financeira' => route('financial-account.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')
    @if( isset($data) )
        {!! Form::model($data, ['route' => ['financial-account.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
    @else
        {!! Form::open(['route' => 'financial-account.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
    @endif

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Conta Financeira</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.financial-account.partials.form')
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Carteira
                <small>Detalhes da conta</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.financial-account.partials.account')
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Instruções
                <small>do Boleto</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.financial-account.partials.instruction')
        </div>
        <!-- /.card-body -->
    </div>


    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script
    <script type="text/javascript" src={{ asset('assets/js/financial-account/validation.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/financial-account/instructions.js') }}></script>
@stop


