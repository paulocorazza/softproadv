@extends('adminlte::page')

@section('title', 'Listagem de Empresas')

@section('content_header')
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Empresas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('tenants') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}" class="active">Empresas</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
@stop

@section('content')

    @include('tenants.includes.alerts')

    <div class="content">
        <p>
            <a href="{{route('companies.create')}}" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus"></span>
                Adicionar
            </a>
        </p>

        <!--FILTRO-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filtrar</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                {!! Form::open(['route' => ['companies.search'], 'class' => 'form form-inline form-search']) !!}

                {!! Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control', 'id' => 'name']) !!}
                {!! Form::text('subdomain', null, ['placeholder' => 'URL', 'class' => 'form-control', 'id' => 'subdomain']) !!}


                {!! Form::submit('Filtrar', ['class' => 'btn btn-danger', 'id' => 'btnSearch']) !!}
                {!! Form::close() !!}

                <a id="search-true" style="display: none" href="{{ route('companies.index') }}">(x) Limpar resultados da
                    pesquisa</a>
            </div>
        </div>
        <!--FILTRO-->


        <!--TABELA -->
        <div id="tabela">
            @include('tenants.companies.partials.table')
        </div>
        <!--TABELA -->
    </div>
@stop

@section('js')

@stop




