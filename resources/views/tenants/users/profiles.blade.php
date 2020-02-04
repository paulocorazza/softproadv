@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('title_postfix', ' - Permissões / Perfil')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                               'breadcrumbs' => [
                                               'Usuários' => route('users.index'),
                                                $user->name]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        <p>
            <a href="{{route('users.profiles.list', $user->id)}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>

        <!--TABELA -->
    @include('tenants.users.partials.table')

    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '/users/' + {{ $user->id }} +'/profile';

        var columns = [
            {data: "id"},
            {data: "name"},
            {data: "label"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>

    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>

    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop






