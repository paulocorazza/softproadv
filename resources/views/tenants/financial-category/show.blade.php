@extends('adminlte::page')

@section('title_postfix', ' - Detalhes da Categoria Financeira')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão da Categoria Financeira',
                               'breadcrumbs' => [
                               'Categoria Financeira' => route('financial-category.index'),
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
                <small>Categoria Financeira</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <p><strong>ID: </strong>{{  $data->id }}</p>
            <p><strong>Tipo: </strong>{{  $data->type }}</p>
            <p><strong>Nome: </strong>{{  $data->name }}</p>
        </div>
        <!-- /.card-body -->
    </div>

    @can('delete_financial_category')
        {!! Form::model($data, ['route' => ['financial-category.destroy', $data->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
        {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete']) !!}
        {!! Form::close() !!}
    @endcan
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop

