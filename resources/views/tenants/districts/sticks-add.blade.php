@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
@stop

@section('title_postfix', ' - Vincular Varas a Comarca')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                                   'breadcrumbs' => [
                                                   'Comarca' => route('districts.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ],
                                                    $district->name])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Varas
                <small>Disponíveis</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            {!! Form::open(['route' => ['districts.sticks.add', $district->id], 'class' => 'form form-search form-ds']) !!}

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

            @foreach($sticks as $stick)
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('sticks[]', $stick->id) !!}
                        {{ $stick->name }}
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


