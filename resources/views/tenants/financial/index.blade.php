@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Financeiro')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão Financeira',
                                               'breadcrumbs' => [
                                               'Financeiro', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_financial')
            <p>
                <a href="{{route('financial.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    <!--TABELA -->
    @include('tenants.financial.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('financial.index') }}';

        var columns = [
            {data: "id"},
            {data: "type"},
            {data: "document"},
            {data: "person.name", name : 'person.name'},
            {data: "due_date"},
            {data: "original"},
            {data: "payday"},
            {data: "payment"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




