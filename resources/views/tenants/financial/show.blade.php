@extends('adminlte::page')

@section('title_postfix', ' - Detalhes da Conta Financeira')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão Financeira',
                               'breadcrumbs' => [
                               'Financeiro' => route('financial.index'),
                               'Detalhes', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Financeiro</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <p><strong>ID: </strong>{{  $data->id }}</p>
            <p><strong>Tipo: </strong>{{  $data->type }}</p>
            <p><strong>Categoria Financeira: </strong>{{  $data->financialCategory->name }}</p>
            <p><strong>Conta Financeira: </strong>{{  $data->financialAccount->description }}</p>
            <p><strong>Pessoa: </strong>{{  $data->person->name }}</p>
            <p><strong>Processo: </strong>{{  @$data->process->number_process }}</p>
            <hr>
            <p><strong>Número do Documento: </strong>{{  $data->document }}</p>
            <p><strong>Data de Vencimento: </strong>{{   \App\Helpers\Helper::formatDateTime($data->due_date, 'd/m/Y')  }}</p>
            <p><strong>Data de Competência: </strong>{{  \App\Helpers\Helper::formatDateTime($data->competence, 'd/m/Y') }}</p>
            <p><strong>Valor Original: </strong>{{  $data->original }}</p>
            <p><strong>Desconto: </strong>{{  $data->discount }}</p>
            <p><strong>Multa: </strong>{{  $data->fine }}</p>
            <p><strong>Juros: </strong>{{  $data->rate }}</p>
            <p><strong>Valor Líquido: </strong>{{  $data->payment }}</p>
            <p><strong>Data da Baixa: </strong>{{  \App\Helpers\Helper::formatDateTime($data->payday, 'd/m/Y')  }}</p>
        </div>
        <!-- /.card-body -->
    </div>

    @can('delete_financial_account')
        {!! Form::model($data, ['route' => ['financial.destroy', $data->id], 'class' => 'form', 'method' => 'delete', 'id' => 'formDelete']) !!}
        {!! Form::submit('Deletar', ['class' => 'btn btn-danger j_delete']) !!}
        {!! Form::close() !!}
    @endcan
@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>
@stop

