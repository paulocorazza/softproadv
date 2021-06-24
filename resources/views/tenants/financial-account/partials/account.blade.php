<div class="row">
    <div class="col-4">
        <div class="form-group label-float">
            {!! Form::text('bank_contract', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'bank_contract']) !!}
            {!! Form::label('bank_contract', 'Carteira', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4 col-12">
        <div class="form-group label-float">
            {!! Form::text('agency', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'agency']) !!}
            {!! Form::label('agency', 'Agência', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-2 col-12">
        <div class="form-group label-float">
            {!! Form::text('agency_dv', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'agency_dv']) !!}
            {!! Form::label('agency_dv', 'Dígito', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4 col-12">
        <div class="form-group label-float">
            {!! Form::text('account', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'account']) !!}
            {!! Form::label('account', 'Conta', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-2 col-12">
        <div class="form-group label-float">
            {!! Form::text('account_dv', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'account_dv']) !!}
            {!! Form::label('account_dv', 'Dígito', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4 col-12">
        <div class="form-group label-float">
            {!! Form::text('assignor', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'assignor']) !!}
            {!! Form::label('assignor', 'Cedente', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-2 col-12">
        <div class="form-group label-float">
            {!! Form::text('assignor_dv', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'assignor_dv']) !!}
            {!! Form::label('assignor_dv', 'Dígito', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4 col-12">
        <div class="form-group">
            {!! Form::label('cnab_shipping', 'CNAB - Remessa', ['class' => 'control-label']); !!}
            {!! Form::select('cnab_shipping', \App\Models\FinancialAccount::CNAB ,  null, ['class' => 'form-control', 'id' => 'cnab_shipping']) !!}
        </div>
    </div>

    <div class="col-sm-4 col-12">
        <div class="form-group">
            {!! Form::label('cnab_return', 'CNAB - Retorno', ['class' => 'control-label']); !!}
            {!! Form::select('cnab_return', \App\Models\FinancialAccount::CNAB ,  null, ['class' => 'form-control', 'id' => 'cnab_return']) !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('agreement', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'agreement']) !!}
            {!! Form::label('agreement', 'Convênio', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('agreement_variation', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'agreement_variation']) !!}
            {!! Form::label('agreement_variation', 'Variação da Carteira', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('accept', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'accept']) !!}
            {!! Form::label('accept', 'Aceite', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('type_account', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'type_account']) !!}
            {!! Form::label('type_account', 'Espécie Doc.', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('fine', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'fine']) !!}
            {!! Form::label('fine', 'Multa % a.m.', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('rate', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'rate']) !!}
            {!! Form::label('rate', 'Juros % a.m.', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('days_of_rate', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'days_of_rate']) !!}
            {!! Form::label('days_of_rate', 'Dias de juros', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-sm-3 col-12">
        <div class="form-group label-float">
            {!! Form::text('days_to_protest', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'days_to_protest']) !!}
            {!! Form::label('days_to_protest', 'Dias para protesto', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4 col-12">
        <div class="form-group label-float">
            {!! Form::text('code_protest', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'code_protest']) !!}
            {!! Form::label('code_protest', 'Código de Protesto', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>
