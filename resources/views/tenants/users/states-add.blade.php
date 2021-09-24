@extends('adminlte::page')

@section('css')

@stop

@section('title_postfix', ' - Vincular Estados')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                                   'breadcrumbs' => [
                                                   'Usuários' => route('users.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ],
                                                    $user->name])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Estados
                <small>Disponíveis</small>
            </h3>
            <!-- tools box -->
            @include('tenants.includes.toolsBox')
            <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            {!! Form::open(['route' => ['users.monitors.add', $user->id], 'class' => 'form form-search form-ds']) !!}

            @foreach($states as $state)
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('states[]', $state->id) !!}
                        {{ $state->letter }} - {{ $state->title  }}
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


