@extends('adminlte::page')

@section('title_postfix', ' - Detalhes do Perfil')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Perfis',
                               'breadcrumbs' => [
                               'Perfis' => route('profiles.index'),
                               'Detalhes', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Perfil</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <p><strong>ID: </strong>{{  $data->id }}</p>
            <p><strong>Descrição: </strong>{{  $data->label }}</p>
        </div>
        <!-- /.card-body -->
    </div>

    @can('delete_profile')
        {!! Form::model($data, ['route' => ['profiles.destroy', $data->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
        {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete']) !!}
        {!! Form::close() !!}
    @endcan
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop

