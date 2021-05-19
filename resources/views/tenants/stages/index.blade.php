@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', ' - Etapas do Processo')

@section('content_header')
    @include('tenants.includes.breadcrumbs',  ['title' => 'Etapas do Processo',
                                               'breadcrumbs' => [
                                               'Etapas', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
       @can('create_stage')
        <p>
            <a href="{{route('stages.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>
        @endcan

        <!--TABELA -->
            @include('tenants.stages.partials.table')
        <!--TABELA -->
    </div>
@stop


@section('js')
    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('stages.index') }}';

        var columns =  [
            {data: "id", name : 'stages.id'},
            {data: "name", name : 'stages.name'},
            {data: "phase.name", name : 'phase.name' },

            {
                data: 'action',
                orderable: false
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop






