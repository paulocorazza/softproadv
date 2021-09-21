@extends('adminlte::page')

@section('css')

@stop

@section('title_postfix', ' - Cadastrar Nova Permissão')

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
                Permissões
                <small>Disponíveis</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            {!! Form::open(['route' => ['profiles.permissions.add', $profile->id], 'class' => 'form form-search form-ds']) !!}

            <div class="form-group">
                <button class="btn btn-primary" id="checkAll">
                    <i class="fas fa-check"></i>
                    Selecionar todos
                </button>
                <button class="btn btn-danger" id="UnCheckAll">
                    <i class="fas fa-square"></i>
                    Desmarcar todos
                </button>
            </div>

            @foreach($permissions as $permission)
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('permissions[]', $permission->id) !!}
                        {{ $permission->label }}
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
    <script src="{{ url('assets/js/all/checkbox.js') }}"></script>
@stop


