<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('bank_code', 'Banco', ['class' => 'control-label']); !!}
            {!! Form::select('bank_code', \App\Models\FinancialAccount::BANKS ,  null, ['class' => 'form-control', 'id' => 'bank_code']) !!}
        </div>
    </div>
</div>

<div class="form-group label-float">
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'description']) !!}
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']); !!}
</div>

<div class="row">
    <div class="col-sm-8 col-12">
        <div class="form-group label-float">
            {!! Form::text('recipient', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'recipient']) !!}
            {!! Form::label('recipient', 'Beneficiário', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-4 col-12">
        <div class="form-group label-float">
            {!! Form::text('cnpj', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cnpj']) !!}
            {!! Form::label('cnpj', 'CNPJ', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-4 col-12">
        <div class="form-group label-float">
            {!! Form::text('cep', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'cep']) !!}
            {!! Form::label('cep', 'Cep', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-8 col-12">
        <div class="form-group label-float">
            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'address']) !!}
            {!! Form::label('address', 'Endereço', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-5 col-12">
        <div class="form-group label-float">
            {!! Form::text('district', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'district']) !!}
            {!! Form::label('district', 'Bairro', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-5 col-12">
        <div class="form-group label-float">
            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'city']) !!}
            {!! Form::label('city', 'Cidade', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-2 col-12">
        <div class="form-group label-float">
            <div class="form-group">
                    {!! Form::select('uf', \App\Support\Enum\UFEnum::UF ,  null, ['class' => 'form-control', 'id' => 'uf']) !!}
            </div>
        </div>
    </div>
</div>
