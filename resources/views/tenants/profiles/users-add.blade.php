@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
@stop

@section('title_postfix', ' - Cadastrar Novo Usuário')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                                   'breadcrumbs' => [
                                                   'Perfis' => route('profiles.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ],
                                                    $profile->name])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Usuarios
                <small>Disponíveis</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            {!! Form::open(['route' => ['profiles.users.add', $profile->id], 'class' => 'form form-search form-ds']) !!}

            @foreach($users as $user)
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('users[]', $user->id) !!}
                        {{ $user->name }}
                    </label>
                </div>

            @endforeach


            <div class="form-group">
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.card-body -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
@stop


