@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Perfis')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Perfis',
                                               'breadcrumbs' => [
                                               'Perfis', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_profile')
            <p>
                <a href="{{route('profiles.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.profiles.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('profiles.index')  }}'

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
@stop




