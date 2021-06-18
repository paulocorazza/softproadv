@extends('adminlte::page')

@include('tenants.includes.dataTableCss')

@section('title_postfix', '- Pessoas')

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => $title,
                                               'breadcrumbs' => [
                                               'Pessoas', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
      <div class="row justify-content-between">
        @can('create_person')
            <a style="margin-left: 10px;" href="{{route('people.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        @endcan


        @can('report_person')
            <a style="margin-right: 10px;" href="{{route('people.report')}}" class="btn btn-dark">
                <span class="fas fa-print"></span>
                Imprimir
            </a>
        @endcan
      </div>
      <br>

    <!--TABELA -->
    @include('tenants.people.partials.table')
    <!--TABELA -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.min.js') }}"></script>

    @include('tenants.includes.dataTableJs')

    <script>
        var urlAjax = '{{ route('people.index') }}';

        var columns = [
            {data: "id"},
            {data: "type_person_list"},
            {data: "name"},
            {data: "email"},
            {
                data: 'action',
                orderable: false,
            }
        ]
    </script>
    <script type="text/javascript" src={{ asset('assets/js/all/table-default.js') }}></script>
@stop




