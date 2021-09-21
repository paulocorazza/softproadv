@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@endsection

@section('title_postfix', ' - Monitoramento de Andamentos')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Monitoramento de Andamentos',
                                               'breadcrumbs' => [
                                               'Monitoramento de Andamentos', ]
                                              ])
@stop

@section('content')
    <div class="content">
        <progress-pending />
    </div>
@stop
