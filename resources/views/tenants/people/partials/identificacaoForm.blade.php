
<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('fantasy', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'fantasy']) !!}
    {!! Form::label('fantasy', 'Fantasia', ['class' => 'control-label']); !!}
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('origin_id', 'Origem', ['class' => 'control-label']); !!}
            {!! Form::select('origin_id', $origins ,  null, ['class' => 'form-control', 'id' => 'origin_id']) !!}
        </div>
    </div>
</div>

<div class="form-group label-float">
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'email']) !!}
    {!! Form::label('email', 'E-mail', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::url('site', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'site']) !!}
    {!! Form::label('site', 'Site', ['class' => 'control-label']); !!}
</div>

<div class="form-group">
    {!! Form::label('type', 'Tipo', ['class' => 'control-label']); !!}
    {!! Form::select('type', ['F' => 'Física', 'J' => 'Jurídica'] ,  null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'type']) !!}
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
</div>


<div class="form-group label-float">
    {!! Form::text('office', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'office']) !!}
    {!! Form::label('office', 'Cargo', ['class' => 'control-label']); !!}
</div>


<div class="form-group label-float">
    {!! Form::file('image',  ['class' => 'form-control', 'placeholder' => ' ']) !!}
    {!! Form::label('image', 'Foto', ['class' => 'control-label']); !!}
</div>

<div class="form-group">
    <label>
        {!! Form::checkbox('status',null) !!}
        Inativo ?
    </label>
</div>
