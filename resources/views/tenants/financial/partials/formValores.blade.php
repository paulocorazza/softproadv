<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::text('document', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'document']) !!}
            {!! Form::label('document', 'Número do Documento', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::date('competence', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'competence']) !!}
            {!! Form::label('competence', 'Data de Competência', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-4">
        <div class="form-group label-float">
            {!! Form::date('due_date', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'due_date']) !!}
            {!! Form::label('due_date', 'Data de Vencimento', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            {!! Form::text('original', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'original_value']) !!}
            {!! Form::label('original', 'Valor Original', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            {!! Form::text('discount', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'discount']) !!}
            {!! Form::label('discount', 'Desconto', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            {!! Form::text('fine', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'fine']) !!}
            {!! Form::label('fine', 'Multa', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            {!! Form::text('rate', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'rate']) !!}
            {!! Form::label('rate', 'Juros', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            {!! Form::date('payday', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'payday']) !!}
            {!! Form::label('payday', 'Data da Baixa', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            {!! Form::text('payment', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'payment_amount', 'readonly']) !!}
            {!! Form::label('payment', 'Valor Líquido', ['class' => 'control-label']); !!}
        </div>
    </div>


</div>



