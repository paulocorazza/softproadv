<div class="form-group">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:', 'id' => 'name']) !!}
</div>

<div class="form-group">
    {!! Form::text('fantasy', null, ['class' => 'form-control', 'placeholder' => 'Fantasia:', 'id' => 'fantasy']) !!}
</div>

<div class="form-group">
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail:', 'id' => 'email']) !!}
</div>

<div class="form-group">
    {!! Form::url('site', null, ['class' => 'form-control', 'placeholder' => 'Site:', 'id' => 'site']) !!}
</div>

@if(!isset($data) )
    <div class="form-group">
        {!! Form::password('password',  ['class' => 'form-control', 'placeholder' => 'Senha:', 'id' => 'password']) !!}
    </div>
    <div class="form-group">
        {!! Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => 'Confirmar Senha:',  'id' => 'password_confirmation']) !!}
    </div>
@endif

<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            {!! Form::text('cpf', null, ['class' => 'form-control', 'placeholder' => 'CPF:', 'id' => 'cpf']) !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group">
            {!! Form::text('cnpj', null, ['class' => 'form-control', 'placeholder' => 'CNPJ:', 'id' => 'cnpj']) !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
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
    {!! Form::text('office', null, ['class' => 'form-control', 'placeholder' => 'Cargo:', 'id' => 'office']) !!}
</div>

<div class="form-group">
    {!! Form::text('salary', null, ['class' => 'form-control', 'placeholder' => 'Salário:', 'id' => 'salary']) !!}
</div>

<label for="journey">Jornada de Trabalho</label>
<div class="row" id="journey">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            {!! Form::time('journey_start', null, ['class' => 'form-control', 'placeholder' => 'Início:', 'id' => 'journey_start']) !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group">
            {!! Form::time('journey_pause', null, ['class' => 'form-control', 'placeholder' => 'Intervalo:', 'id' => 'journey_pause']) !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group">
            {!! Form::time('journey_end', null, ['class' => 'form-control', 'placeholder' => 'Término:', 'id' => 'journey_end']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label>Foto: </label>
    {!! Form::file('image',  ['class' => 'form-control']) !!}
</div>
