<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('type_person', 'Tipo de Pessoa', ['class' => 'control-label']); !!}
            {!! Form::select('type_person', \App\Models\Person::TYPE_PERSON ,  null, ['class' => 'form-control', 'disabled' => $disabled, 'multiple' => 'multiple', 'id' => 'type_person', 'name' => 'type_person[]']) !!}
        </div>
    </div>
</div>

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'name', 'disabled' => $disabled ]) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('fantasy', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'fantasy', 'disabled' => $disabled]) !!}
    {!! Form::label('fantasy', 'Fantasia', ['class' => 'control-label']); !!}
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('origin_id', 'Origem', ['class' => 'control-label']); !!}
            {!! Form::select('origin_id', $origins ,  null, ['class' => 'form-control', 'id' => 'origin_id', 'disabled' => $disabled]) !!}
        </div>
    </div>
</div>

<div class="form-group label-float">
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'email', 'disabled' => $disabled]) !!}
    {!! Form::label('email', 'E-mail', ['class' => 'control-label']); !!}
</div>

<div class="form-group label-float">
    {!! Form::text('site', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'site', 'disabled' => $disabled]) !!}
    {!! Form::label('site', 'Site', ['class' => 'control-label']); !!}
</div>

<div class="form-group">
    {!! Form::label('type', 'Tipo', ['class' => 'control-label']); !!}
    {!! Form::select('type', ['F' => 'Física', 'J' => 'Jurídica'] ,  null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'type', 'disabled' => $disabled]) !!}
</div>

<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::text('cpf', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cpf', 'disabled' => $disabled]) !!}
            {!! Form::label('cpf', 'CPF', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::text('cnpj', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cnpj', 'disabled' => $disabled]) !!}
            {!! Form::label('cnpj', 'CNPJ', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::text('rg', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'rg', 'disabled' => $disabled]) !!}
            {!! Form::label('rg', 'RG', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('cellphone', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cellphone', 'disabled' => $disabled]) !!}
            {!! Form::label('cellphone', 'Celular', ['class' => 'control-label']); !!}           </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'telephone', 'disabled' => $disabled]) !!}
            {!! Form::label('telephone', 'Telefone', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::date('date_birth', null, ['class' => 'form-control',  'id' => 'date_birth', 'placeholder' => '', 'disabled' => $disabled]) !!}
            {!! Form::label('date_birth', 'Data de Aniversário', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('office', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'office', 'disabled' => $disabled]) !!}
            {!! Form::label('office', 'Cargo', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="form-group">
    <label>
        {!! Form::checkbox('status', null, @$data->status == 'I', ['disabled' => $disabled]) !!}
        Inativo
    </label>
</div>
