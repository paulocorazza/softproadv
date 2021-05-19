<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('type', 'Tipo', ['class' => 'control-label']); !!}
            {!! Form::select('type', \App\Models\Financial::TYPE ,  null, ['class' => 'form-control', 'id' => 'type']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('financial_category_id', 'Categoria Financeira *', ['class' => 'control-label']); !!}
            {!! Form::select('financial_category_id', $category ,  null, ['class' => 'form-control', 'id' => 'financial_category_id']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('financial_account_id', 'Conta Financeira *', ['class' => 'control-label']); !!}
            {!! Form::select('financial_account_id', $account ,  null, ['class' => 'form-control', 'id' => 'financial_account_id']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('person_id', 'Pessoa *', ['class' => 'control-label']); !!}
            {!! Form::select('person_id', $person ,  null, ['class' => 'form-control', 'id' => 'person_id']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('process_id', 'Processo', ['class' => 'control-label']); !!}
            {!! Form::select('process_id', $process ,  null, ['class' => 'form-control', 'id' => 'process_id']) !!}
        </div>
    </div>
</div>

<div class="form-group label-float">
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'description']) !!}
    {!! Form::label('description', 'Descrição', ['class' => 'control-label']); !!}
</div>


