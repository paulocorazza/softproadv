@extends('adminlte::page')

@section('css')

@stop

@section('title_postfix', ' - Cadastrar Nova Fase')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                                   'breadcrumbs' => [
                                                   'Tipo de Ações' => route('type-actions.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ],
                                                    $typeAction->name])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Fases
                <small>Disponíveis</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            {!! Form::open(['route' => ['type-actions.phase.add', $typeAction->id], 'class' => 'form form-search form-ds']) !!}

            @foreach($phases as $phase)
                <div class="form-group">
                    <label>
                        {!! Form::checkbox('phases[]', $phase->id) !!}
                        {{ $phase->name }}
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


