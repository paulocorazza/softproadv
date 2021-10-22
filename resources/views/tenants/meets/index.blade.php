@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Atendimentos')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Atendimentos',
                                               'breadcrumbs' => [
                                               'Atendimentos', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">

        @can('create_meet')
            <p>
                <a href="{{route('meets.create')}}" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span>
                    Adicionar
                </a>
            </p>
         @endcan

    @include('tenants.meets.partials.search')

    <!--TABELA -->
    @include('tenants.meets.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('meets.index') }}';

        var columns = [
            {data: "id"},
            {data: "process.number_process", name : 'process.number_process', orderable: false},
            {data: 'listAdv', name: 'listAdv', orderable: false, searchable: false},
            {data: "title"},
            {data: "person"},
            {data: "created_at_br"},
            {data: "concluded_at"},
            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/meets/table.js') }}></script>
@stop




