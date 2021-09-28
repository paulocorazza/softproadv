@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@endsection

@section('title_postfix', ' - Monitoramento de Processos')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Monitoramento de Processos',
                                               'breadcrumbs' => [
                                               'Monitoramento de Processos', ]
                                              ])
@stop

@section('content')
    <div class="content">
        <process-pending data-app />
    </div>
@stop
