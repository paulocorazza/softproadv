@if( isset($data) )
    {!! Form::model($data, ['route' => ['forums.update', $data->id], 'class' => 'form', 'method' => 'put', 'id' => 'formRegister', 'files' => true ]) !!}
@else
    {!! Form::open(['route' => 'forums.store', 'class' => 'form', 'id' => 'formRegister', 'files' => true]) !!}
@endif

<div class="form-group label-float">
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'name']) !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']); !!}
</div>

<div class="row">
    <div class="col-4">
        <div class="form-group label-float">
            {!! Form::text('cep', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cep']) !!}
            {!! Form::label('cep', 'Cep', ['class' => 'control-label']); !!}

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-10">
        <div class="form-group label-float">
            {!! Form::text('street', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'street']) !!}
            {!! Form::label('street', 'Rua', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-2">
        <div class="form-group label-float">
            {!! Form::text('number', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'number']) !!}
            {!! Form::label('number', 'Número', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('district', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'district']) !!}
            {!! Form::label('district', 'Bairro', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('complement', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'complement']) !!}
            {!! Form::label('complement', 'Complemento', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-9">
        <div class="form-group label-float">
            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'city']) !!}
            {!! Form::label('city', 'Cidade', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-3">
        Estado
        {!! Form::select('uf', \App\Support\Enum\UFEnum::UF , null, ['class' => 'form-control', 'id' => 'estado']) !!}
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('telephone', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'telephone']) !!}
            {!! Form::label('telephone', 'Telefone', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('site', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'site']) !!}
            {!! Form::label('site', 'Site', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


{!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}

<br/>

