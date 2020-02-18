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

@section('title_postfix', 'Cadastrar Novo Usuário')

@section('content_header')
    <div class="container-fluid">
        @include('tenants.includes.breadcrumbs',  ['title' => 'Gestão de Usuários',
                               'breadcrumbs' => [
                               'Usuários' => route('users.index'),
                                isset($data->id) ? 'Editar' : 'Cadastrar', ]
                              ])
    </div><!-- /.container-fluid -->
@stop

@section('content')
    @include('tenants.includes.alerts')

    @if( isset($data) )
        {!! Form::model($data, ['route' => ['users.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
    @else
        {!! Form::open(['route' => 'users.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
    @endif

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
            @include('tenants.users.partials.form')
        </div>
        <!-- /.card-body -->
    </div>

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
                                @include('tenants.users.partials.formAddress')
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

                <table class="table table-responsive table-hover" id="address_table">
                    <thead>
                    <tr>
                        <th width="12%">Tipo</th>
                        <th width="24%">Rua</th>
                        <th width="5%">Número</th>
                        <th width="16%">Bairro</th>
                        <th width="20%">Cidade</th>
                        <th width="8%">UF</th>
                        <th width="11%">Cep</th>
                        <th>Ação</th>
                    </tr>
                    </thead>

                    <tbody class="j_list">
                    <!-- /foreach addresses -->
                    @if(isset($data))
                        @forelse($data->addresses as $address)
                            <tr data-id="{{ $address->id }}" id="address{{ $address->id }}">
                                <td>
                                    <input type="hidden"
                                           name="address[{{ $address->id }}][id]"
                                           value="{{ $address->id }}">

                                    <input type="hidden"
                                           name="address[{{ $address->id }}][complement]"
                                           value="{{ $address->complement }}">

                                    <input type="hidden"
                                           name="address[{{ $address->id }}][country_id]"
                                           value="{{ $address->country_id }}">


                                    <select class="form-control"
                                            readonly
                                            name="address[{{ $address->id }}][type_address_id]">
                                        <option
                                            value="{{ $address->type_address_id }}"> {{ $address->type_address->description }}</option>
                                    </select>

                                </td>

                                <td>
                                    <input class="form-control" readonly type="text"
                                           name="address[{{ $address->id }}][street]"
                                           value="{{ $address->street }}">
                                </td>

                                <td>
                                    <input class="form-control" readonly type="text"
                                           name="address[{{ $address->id }}][number]"
                                           value="{{ $address->number }}">
                                </td>

                                <td>
                                    <input class="form-control" readonly type="text"
                                           name="address[{{ $address->id }}][district]"
                                           value="{{ $address->district }}">
                                </td>



                                <td>
                                    <select class="form-control"
                                            readonly
                                            name="address[{{ $address->id }}][city_id]">
                                        <option
                                            value="{{ $address->city_id }}"> {{ $address->city->name }}</option>
                                    </select>
                                </td>

                                <td>
                                    <select class="form-control"
                                            readonly
                                            name="address[{{ $address->id }}][state_id]">
                                        <option
                                            value="{{ $address->state_id }}"> {{ $address->state->initials }}</option>
                                    </select>
                                </td>


                                <td>
                                    <input class="form-control" readonly type="text"
                                           name="address[{{ $address->id }}][cep]"
                                           value="{{ $address->cep }}">
                                </td>



                                <td>
                                    <a rel="{{ $address->id }}" class="badge bg-yellow" href="javascript:;"
                                       onclick="editDetail(this)">Editar</a>

                                    <a rel="{{ $address->id }}" class="badge bg-danger" href="javascript:;"
                                       onclick="removeDetail(this)">Excluir</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Nenhum Endereço Adicionado</td>
                            </tr>
                        @endforelse
                    @endif
                    <!-- /.end foreach addresses -->
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->
    </div>


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

        </div>
        <!-- /.card-body -->
    </div>



    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}


@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script src={{ asset('vendor/alertify/js/alertify.min.js') }}></script>
    <script src={{ asset('assets/js/users/validation.js') }}></script>
    <script src={{ asset('assets/js/all/address.js') }}></script>
@stop


