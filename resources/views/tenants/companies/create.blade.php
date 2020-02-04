@extends('adminlte::page')

@section('title_postfix', ' - Cadastrar Nova Empresa')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Gestão de Empresas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('tenants') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('companies.index') }}">Empresas</a>
                    </li>

                    @if (isset($company))
                        <li class="breadcrumb-item"><a href="{{ route('companies.edit' , $company->id) }}"
                                                       class="active">Editar</a></li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ route('companies.create' ) }}"
                                                       class="active">Cadastrar</a></li>
                    @endif
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Empresa</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.companies.partials.form')
        </div>
        <!-- /.card-body -->
    </div>
@stop


