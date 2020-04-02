@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Permissões / Perfil')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                               'breadcrumbs' => [
                                               'Permissões' => route('permissions.index'),
                                                $permission->name]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        <p>
            <a href="{{route('permissions.profiles.list', $permission->id)}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>

        <!--TABELA -->
    @include('tenants.permissions.partials.table')


    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')


    <script>
        var urlAjax = '{{ route('permissions.profiles', $permission->id)  }}' ;

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
    <script type="text/javascript" src={{ asset('assets/js/table-default.js') }}></script>
@stop





