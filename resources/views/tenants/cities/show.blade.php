@extends('adminlte::page')

@section('title_postfix', ' - Cidades')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Cidades',
                       'breadcrumbs' => [
                       'Cidades' => route('cities.index'),
                       'Detalhes', ]
                      ])
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Cidades</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <p><strong>IBGE: </strong>{{  $data->ibge }}</p>
            <p><strong>Estado: </strong>{{  $data->state->name }}</p>
            <p><strong>Nome: </strong>{{  $data->name }}</p>
        </div>
        <!-- /.card-body -->
    </div>

    {!! Form::model($data, ['route' => ['cities.destroy', $data->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
    {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete', 'rel' => $data->id ]) !!}
    {!! Form::close() !!}
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop



