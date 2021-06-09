{!! Form::label('judge_id', 'Juiz', ['class' => 'control-label']); !!}
<div class="form-group">
    {!! Form::select('judge_id', $judge, null, ['placeholder' => 'Selecione o Juiz', 'class' => 'form-control',  'id' => 'judge_id']) !!}
</div>

<div class="row">
    <div class="col-12">
        {!! Form::label('status', 'Tipo de Processo', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('type_process', \App\Models\Process::TYPE_PROCESS, isset($data) ? $data->type_process : 'Não Ajuizado', ['placeholder' => '', 'class' => 'form-control', 'id' => 'type_process']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('number_process', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'number_process']) !!}
            {!! Form::label('number_process', 'Número do Processo', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('protocol', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'protocol']) !!}
            {!! Form::label('protocol', 'Número do protocolo', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('folder', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'folder']) !!}
            {!! Form::label('folder', 'Número da pasta', ['class' => 'control-label']); !!}
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::date('date_request', null, ['class' => 'form-control',  'id' => 'date_request', 'placeholder' => '']) !!}
            {!! Form::label('date_request', 'Data do Requerimento', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('expectancy', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'expectancy']) !!}
            {!! Form::label('expectancy', 'Expectativa/Valor da causa', ['class' => 'control-label']); !!}
        </div>
    </div>



    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('price', null, ['class' => 'form-control money', 'placeholder' => ' ', 'id' => 'price']) !!}
            {!! Form::label('price', 'Valor dos honorários', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="form-group label-float">
    {!! Form::text('percent_fees', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'percent_fees']) !!}
    {!! Form::label('percent_fees', 'Honorários (%)', ['class' => 'control-label']); !!}
</div>

<div class="row">
    <div class="col-12">
        {!! Form::label('users', 'Advogados', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('users', $users, null, ['class' => 'form-control',  'multiple' => 'multiple',  'id' => 'users', 'name' => 'users[]']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Anotações gerais', 'id' => 'description', 'cols' => 20, 'rows' => 6]) !!}
        </div>
    </div>
</div>


