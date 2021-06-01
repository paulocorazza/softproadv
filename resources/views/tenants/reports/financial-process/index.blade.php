@extends('adminlte::page')

@section('title_postfix', ' - Relatório de Ficha Financeira de Processos')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content')
    @include('tenants.includes.alerts')

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Relatório de Ficha Financeira de Processos
                <small>Filtros</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <form action="{{ route('financial.process.report') }}" method="post" class="form" id="formRel">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="date_for">Por data de:</label>
                            <select name="date_for" class="form-control">
                                <option value="due_date">Vencimento</option>
                                <option value="competence">Competência</option>
                                <option value="payday">Baixa</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="data_inicial">Data Inicial:</label>
                            <input type="date" name="data_inicial"  id="data_inicial" class="form-control">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="data_final">Data Final:</label>
                            <input type="date" name="data_final"  id="data_final" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="data_inicial">Pessoa</label>
                            {!! Form::select('person_id', $person, null, ['placeholder' => 'Selecione a Pessoa', 'class' => 'form-control',  'id' => 'person_id']) !!}
                        </div>
                    </div>
                </div>

                <input type="submit" value="Gerar Relatório" formtarget="_blank" class="btn btn-primary">
            </form>
        </div>
        <!-- /.card-body -->
    </div>


@stop

@section('js')
    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/all/confirmations.js') }}></script>

    <script type="text/javascript" src={{ asset('assets/js/people/person-select.js') }}></script>
@stop



