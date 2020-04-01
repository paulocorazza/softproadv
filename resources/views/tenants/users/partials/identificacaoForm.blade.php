
<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('fantasy', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'fantasy']) !!}
    {!! Form::label('fantasy', 'Fantasia', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'email']) !!}
    {!! Form::label('email', 'E-mail', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::url('site', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'site']) !!}
    {!! Form::label('site', 'Site', ['class' => 'control-label']); !!}
</div>

@if(!isset($data) )
    <div class="form-group label-float">
        {!! Form::password('password',  ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'password']) !!}
        {!! Form::label('password', 'Senha', ['class' => 'control-label']); !!}
    </div>
    <div class="form-group label-float">
        {!! Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => ' ',  'id' => 'password_confirmation']) !!}
        {!! Form::label('password_confirmation', 'Confirmar Senha', ['class' => 'control-label']); !!}
    </div>
@endif


<div class="form-group">
    {!! Form::label('type', 'Tipo', ['class' => 'control-label']); !!}
    {!! Form::select('type', ['A' => 'Advogado', 'U' => 'Usuário'] ,  null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'type']) !!}
</div>

<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::text('cpf', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cpf']) !!}
            {!! Form::label('cpf', 'CPF', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::text('cnpj', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cnpj']) !!}
            {!! Form::label('cnpj', 'CNPJ', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::text('rg', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'rg']) !!}
            {!! Form::label('rg', 'RG', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('oab', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'oab']) !!}
            {!! Form::label('oab', 'OAB', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('ctps', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'ctps']) !!}
            {!! Form::label('ctps', 'CTPS', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('cellphone', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cellphone']) !!}
            {!! Form::label('cellphone', 'Celular', ['class' => 'control-label']); !!}           </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'telephone']) !!}
            {!! Form::label('telephone', 'Telefone', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::date('date_birth', null, ['class' => 'form-control',  'id' => 'date_birth', 'placeholder' => '']) !!}
            {!! Form::label('date_birth', 'Data de Aniversário', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::date('date_admission', null, ['class' => 'form-control', 'id' => 'date_admission', 'placeholder' => ' ']) !!}
            {!! Form::label('date_admission', 'Data de Admissão', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::date('date_resignation', null, ['class' => 'form-control', 'id' => 'date_resignation', 'placeholder' => ' ']) !!}
            {!! Form::label('date_resignation', 'Data do desligamento', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="form-group label-float">
    {!! Form::text('office', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'office']) !!}
    {!! Form::label('office', 'Cargo', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('salary', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'salary']) !!}
    {!! Form::label('salary', 'Salário', ['class' => 'control-label']); !!}
</div>

<label for="journey">Jornada de Trabalho</label>
<div class="row" id="journey">
    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::time('journey_start', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'journey_start']) !!}
            {!! Form::label('journey_start', 'Início', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::time('journey_pause', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'journey_pause']) !!}
            {!! Form::label('journey_pause', 'Intervalo', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::time('journey_end', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'journey_end']) !!}
            {!! Form::label('journey_end', 'Término', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="form-group label-float">
    {!! Form::file('image',  ['class' => 'form-control', 'placeholder' => ' ']) !!}
    {!! Form::label('image', 'Foto', ['class' => 'control-label']); !!}
</div>
