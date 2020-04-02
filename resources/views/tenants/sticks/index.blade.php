@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Varas')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Varas',
                                               'breadcrumbs' => [
                                               'Varas', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_stick')
            <p>
                <a href="{{route('sticks.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.sticks.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('sticks.index') }}';

        var columns = [
            {data: "id"},
            {data: "name"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




