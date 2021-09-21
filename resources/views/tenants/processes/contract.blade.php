@extends('adminlte::page')

@section('adminlte_css')

    <style type="text/css">
        .table td, .table th {
            padding: 0.30rem;
        }
    </style>
@stop


@section('title_postfix', ' - Contrato do Processos')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' =>  isset($data->id) ? 'Gestão de Processos - ' . $data->number_process : 'Gestão de Processos' ,
                               'breadcrumbs' => [
                               'Processos' => route('processes.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop


@section('content')
    @include('tenants.includes.alerts')

    <div class="alert alert-warning" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-exclamation"></i> Atenção!</h4>
        <div id="warning"></div>
    </div>

        {!! Form::model($data, ['route' => ['processes.contract.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true]) !!}

    <!-- /.Contrato -->
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Contrato
                <small>do Processo</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <div class="d-flex justify-content-between">
                <button id="btnContract" type="button" class="btn btn-primary" data-toggle="modal"
                        data-target=".modal-contract">Adicionar Contrato
                </button>

                <a href="{{ route('processes.contract.preview', $data->id)  }}"  target="_blank" id="preview" class="btn btn-dark">Imprimir</a>
            </div>
            <br>

            <div id="modalContract" class="modal fade modal-contract" tabindex="-1" role="dialog"
                 aria-labelledby="modalLarge" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLarge">Contratos</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <select class="form-control" name="all_contracts" id="all_contracts">
                                    @foreach($contracts as $contract)
                                        <option value="{{$contract->contract}}">{{ $contract->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                            <button id="btnSaveUpdateContract" type="button" class="btn btn-primary">Adicionar</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                {!! Form::textarea('contract',null, ['class' => 'form-control', 'placeholder' => 'Contrato', 'id' => 'editor']) !!}
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.Contrato -->


    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}

    <div class="preload">
        @include('tenants.includes.load')
    </div>
@stop


@section('js')
    <script>
        var submitAjaxPut = "{{ route('processes.update', isset($data->id) ? $data->id : 0 ) }}"
    </script>

    <script src="{{ url('vendor/ckeditor/bundle.js') }}"></script>
    <script>
      editor =  new editor("#editor", {!!  json_encode(array_values(App\Enum\Tag::Tags()))   !!} );
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.js') }}"></script>

    <script type="text/javascript" src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script type="text/javascript" src={{ asset('assets/js/processes/contract.js') }}></script>

@stop


