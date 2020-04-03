@extends('adminlte::page')

@section('adminlte_css')
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.core.css') }} />
    <link rel="stylesheet" href={{ asset('vendor/alertify/css/alertify.default.css') }} />
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <style type="text/css">
        .table td, .table th {
            padding: 0.30rem;
        }
    </style>
@stop

@section('title_postfix', ' - Cadastrar Nova Pessoa')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Pessoas',
                               'breadcrumbs' => [
                               'Pessoas' => route('people.index'),
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

    @if( isset($data) )
        {!! Form::model($data, ['route' => ['people.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
    @else
        {!! Form::open(['route' => 'people.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
    @endif


    <!-- /.Identificação -->
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Dados pessoais</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.people.partials.identificacaoForm')
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.Identificação -->

    <!-- /.Endereços -->
    <div class="card card-outline card-blue">
        <div class="card-header">
            <h3 class="card-title">
                Endereços
                <small>Adicionar</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <button id="btnEndereco" type="button" class="btn btn-primary" data-toggle="modal"
                    data-target=".modal-address">Adicionar
            </button>
            <br>
            <br>

            <div id="modalAddress" class="modal fade modal-address" tabindex="-1" role="dialog"
                 aria-labelledby="modalLarge" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLarge">Endereço</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                @include('tenants.all.partials.address.addressForm')
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                            <button id="btnSaveUpdateAddress" type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @include('tenants.includes.load')
                @include('tenants.all.partials.address.table-address')
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.Endereços -->


    <!-- /.Contatos -->
    <div class="card card-outline card-blue">
        <div class="card-header">
            <h3 class="card-title">
                Contatos
                <small>Outros Contatos</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <button id="btnContact" type="button" class="btn btn-primary" data-toggle="modal"
                    data-target=".modal-contact">Adicionar
            </button>
            <br>
            <br>

            <div id="modalContact" class="modal fade modal-contact" tabindex="-1" role="dialog"
                 aria-labelledby="modalLarge" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalLarge">Contato</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                @include('tenants.all.partials.contact.contactForm')
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                            <button id="btnSaveUpdateContact" type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @include('tenants.includes.load')
                @include('tenants.all.partials.contact.table-contact')
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.Contatos -->

    <!-- /.Outros Dados -->
    <div class="card card-outline card-gray">
        <div class="card-header">
            <h3 class="card-title">
                Outros Dados
                <small>Informações adicionais</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            @include('tenants.people.partials.outrosDadosForm')
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.Outros Dados -->


    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <div class="preload">
        @include('tenants.includes.load')
    </div>
    {!! Form::close() !!}


@stop

@section('js')
    <script>
        var submitAjaxPut = "{{ route('people.update', isset($data->id) ? $data->id : 0 ) }}"
        var submitAjax = "{{ route('people.store') }}";
        var deleteAddressAjax = "{{ route('delete_address') }}";
        var deleteContactAjax = "{{ route('delete_contact') }}";
    </script>

    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script src={{ asset('assets/js/people/validation.js') }}></script>
    <script src={{ asset('assets/js/all/address.js') }}></script>
    <script src={{ asset('assets/js/all/contact.js') }}></script>
@stop


