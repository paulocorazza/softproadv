@extends('adminlte::page')

@section('title_postfix', ' - Minha Conta' )

@section('content_header')

    @include('tenants.includes.breadcrumbs',  ['title' => 'Minha Conta',
                                               'breadcrumbs' => [
                                               'Minha Conta', ]
                                              ])
@stop

@section('content')

    @include('tenants.includes.alerts')

    {!! Form::model($data, ['route' => ['profile.update', $data->id], 'class' => 'form form-search form-ds', 'files' => true, 'method' => 'put', 'id' => 'formRegister']) !!}

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Identificação
                <small>Dados Pessoais</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            <div class="form-group">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:', 'id' => 'name']) !!}
            </div>

            <div class="form-group ">
                {!! Form::text('fantasy', null, ['class' => 'form-control', 'placeholder' => 'Fantasia:', 'id' => 'fantasy']) !!}
            </div>

            <div class="form-group">
                {!! Form::hidden('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
            </div>

            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        {!! Form::text('cpf', null, ['class' => 'form-control', 'placeholder' => 'CPF:', 'id' => 'cpf']) !!}
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        {!! Form::text('rg', null, ['class' => 'form-control', 'placeholder' => 'RG:', 'id' => 'rg']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="type">Tipo:</label>
                {!! Form::select('type', ['A' => 'Advogado', 'U' => 'Usuário'] ,  null, ['class' => 'form-control', 'id' => 'type']) !!}
            </div>


            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        {!! Form::text('ctps', null, ['class' => 'form-control', 'placeholder' => 'CTPS:', 'id' => 'ctps']) !!}
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        {!! Form::text('oab', null, ['class' => 'form-control', 'placeholder' => 'OAB:', 'id' => 'oab']) !!}
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        {!! Form::text('cellphone', null, ['class' => 'form-control', 'placeholder' => 'Celular:', 'id' => 'cellphone']) !!}
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => 'Telefone:', 'id' => 'telephone']) !!}
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="date_birth">Data de Aniversário</label>
                        {!! Form::date('date_birth', null, ['class' => 'form-control',  'id' => 'date_birth']) !!}

                    </div>
                </div>

                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="date_admission">Data de Admissão</label>
                        {!! Form::date('date_admission', null, ['class' => 'form-control', 'id' => 'date_admission']) !!}

                    </div>
                </div>


                <div class="col-12 col-sm-4">
                    <div class="form-group">
                        <label for="date_resignation">Data do desligamento</label>
                        {!! Form::date('date_resignation', null, ['class' => 'form-control', 'id' => 'date_resignation']) !!}
                    </div>
                </div>
            </div>


            <div class="form-group">
                {!! Form::text('salary', null, ['class' => 'form-control', 'placeholder' => 'Salário:', 'id' => 'salary']) !!}
            </div>



            <div class="form-group">
                {!! Form::file('image',  ['class' => 'form-control']) !!}
            </div>



        </div>
        <!-- /.card-body -->
    </div>

    @include('tenants.users.partials.googleCalendarForm')

    <div class="form-group">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">
                Usuário
                <small>Alterar Senha</small>
            </h3>
            <!-- tools box -->
        @include('tenants.includes.toolsBox')
        <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pad">
            {!! Form::model($data, ['route' => ['profile.password', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegisterPassword']) !!}

            <div class="form-group label-float">
                {!! Form::password('password',  ['class' => 'form-control', 'placeholder' => 'Nova Senha', 'id' => 'password']) !!}
            </div>
            <div class="form-group label-float">
                {!! Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => 'Confirmação da Senha',  'id' => 'password_confirmation']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Alterar Senha', ['class' => 'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}

        </div>
        <!-- /.card-body -->
    </div>
@stop

@section('js')
    <script src="{{ url('vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/additional-methods.js') }}"></script>
    <script src="{{ url('vendor/jquery/messages_pt_BR.min.js') }}"></script>
    <script src="{{ url('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script type="text/javascript" src={{ asset('assets/js/users/validationProfile.js') }}></script>
@stop

