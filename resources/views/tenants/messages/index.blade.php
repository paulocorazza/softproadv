@extends('adminlte::page')

@section('title_postfix', ' - Mensagens')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Mensagens',
                                               'breadcrumbs' => [
                                               'Mensagens', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        <chat></chat>
    </div>
@stop






