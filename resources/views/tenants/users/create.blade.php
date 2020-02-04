@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">

@stop

@section('title_postfix', 'Cadastrar Novo Usuário')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Usuários',
                               'breadcrumbs' => [
                               'Usuários' => route('users.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop

@section('content')
    @include('tenants.includes.alerts')

    @if( isset($data) )
        {!! Form::model($data, ['route' => ['users.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
    @else
        {!! Form::open(['route' => 'users.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
    @endif

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Dados pessoais</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.users.partials.form')
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-outline card-blue">
        <div class="card-header">
            <h3 class="card-title">
                Endereços
                <small>Adicionar</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">

        </div>
        <!-- /.card-body -->
    </div>


    <div class="card card-outline card-gray">
        <div class="card-header">
            <h3 class="card-title">
                Outros Dados
                <small>Informações adicionais</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">

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
    <script type="text/javascript" src={{ asset('assets/js/users/validation.js') }}></script>
@stop


