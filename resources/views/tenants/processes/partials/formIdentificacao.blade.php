{!! Form::label('person_id', 'Cliente', ['class' => 'control-label']); !!}
<div class="form-group">
    {!! Form::select('person_id', $person, null, ['placeholder' => 'Selecione o Cliente', 'class' => 'form-control',  'id' => 'person_id']) !!}
</div>

{!! Form::label('counterpart_id', 'Parte Contrária', ['class' => 'control-label']); !!}
<div class="form-group">
    {!! Form::select('counterpart_id', $counterpart, null, ['placeholder' => 'Selecione a Parte Contrária', 'class' => 'form-control', 'id' => 'counterpart_id']) !!}
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        {!! Form::label('forum_id', 'Forum', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('forum_id', $forums, null, ['placeholder' => 'Selecione o Forum', 'class' => 'form-control', 'id' => 'forum_id']) !!}
        </div>
    </div>

    <div class="col-12 col-sm-6">
        {!! Form::label('stick_id', 'Vara', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('stick_id', $sticks, null, ['placeholder' => 'Selecione a Vara', 'class' => 'form-control', 'id' => 'stick_id']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        {!! Form::label('district_id', 'Comarca', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('district_id', $districts, null, ['placeholder' => 'Selecione a Comarca', 'class' => 'form-control', 'id' => 'district_id']) !!}
        </div>
    </div>
</div>

{!! Form::label('group_action_id', 'Grupo de Ações', ['class' => 'control-label']); !!}
<div class="form-group">
    {!! Form::select('group_action_id', $groupActions, null, ['placeholder' => 'Selecione o Grupo de Ações', 'class' => 'form-control', 'id' => 'group_action_id']) !!}
</div>

{!! Form::label('type_action_id', 'Tipo de Ação', ['class' => 'control-label']); !!}
<div class="form-group">
    {!! Form::select('type_action_id', $typeActions, null, ['placeholder' => 'Selecione o Tipo de Ação', 'class' => 'form-control', 'id' => 'type_action_id']) !!}
</div>
<div class="jloadTypeAction">
    @include('tenants.includes.load')
</div>


<div class="row">
    <div class="col-12 col-sm-6">
        {!! Form::label('phase_id', 'Fase', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('phase_id', $phases, null, ['placeholder' => 'Selecione a Fase', 'class' => 'form-control', 'id' => 'phase_id']) !!}
        </div>

        <div class="jloadPhase">
            @include('tenants.includes.load')
        </div>
    </div>

    <div class="col-12 col-sm-6">
        {!! Form::label('stage_id', 'Etapa', ['class' => 'control-label']); !!}
        <div class="form-group">
            {!! Form::select('stage_id', $stages, null, ['placeholder' => 'Selecione a Etapa', 'class' => 'form-control', 'id' => 'stage_id']) !!}
        </div>

        <div class="jloadStage">
            @include('tenants.includes.load')
        </div>
    </div>
</div>
