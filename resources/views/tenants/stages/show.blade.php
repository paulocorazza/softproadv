@extends('adminlte::page')

@section('title_postfix', ' - Etapas das Ações')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Etapas das Ações',
                           'breadcrumbs' => [
                           'Etapas' => route('stages.index'),
                            isset($data->id) ? 'Editar' : 'Cadastrar', ]
                          ])
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Tipo de Ação</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <p><strong>ID: </strong>{{  $data->id }}</p>
            <p><strong>Etapa da Ação: </strong>{{  $data->name }}</p>
            <p><strong>Fase da Ação: </strong>{{  $data->phase->name }}</p>


        </div>
        <!-- /.card-body -->
    </div>

    @can('delete_stage')
    {!! Form::model($data, ['route' => ['stages.destroy', $data->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
    {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete', 'rel' => $data->id ]) !!}
    {!! Form::close() !!}
    @endcan
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop



