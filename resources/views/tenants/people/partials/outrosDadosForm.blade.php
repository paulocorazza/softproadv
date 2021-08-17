<div class="row">
    <div class="col-12 col-sm-3">
        <div class="form-group">
            {!! Form::select('marital_status', ['Solteiro' => 'Solteiro', 'Casado' => 'Casado', 'Separado' => 'Separado', 'Divorciado' => 'Divorciado', 'Viúvo' => 'Viúvo'] ,  null, ['class' => 'form-control', 'id' => 'marital_status', 'disabled' => $disabled]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('partner', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'partner', 'disabled' => $disabled]) !!}
            {!! Form::label('partner', 'Conjuge', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('father', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'father', 'disabled' => $disabled]) !!}
            {!! Form::label('father', 'Pai', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('mother', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'mother', 'disabled' => $disabled]) !!}
            {!! Form::label('mother', 'Mãe', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('naturalness', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'naturalness', 'disabled' => $disabled]) !!}
            {!! Form::label('naturalness', 'Natural', ['class' => 'control-label']); !!}
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::text('nationality', null, ['class' => 'form-control', 'placeholder' => ' ', 'id' => 'nationality', 'disabled' => $disabled]) !!}
            {!! Form::label('nationality', 'Nacionalidade', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::textarea('observation', null, ['class' => 'form-control', 'placeholder' => 'Observação', 'id' => 'observation', 'disabled' => $disabled]) !!}
        </div>
    </div>
</div>



