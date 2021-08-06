@if(isset($home))
    <div class="alert alert-warning" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-exclamation"></i> Atenção!</h4>
        <div id="warning"></div>
    </div>


    <div class="row">
        <div class="col-12">
            {!! Form::label('process_event_id', 'Processo', ['class' => 'control-label']); !!}
            <div class="form-group">
                {!! Form::select('process_event_id', [], null, ['placeholder' => 'Selecione o Processo', 'class' => 'form-control',  'id' => 'process_event_id']) !!}
            </div>
        </div>
    </div>

    <input type="hidden" value="" id="id_audience">
@endif

<div class="row">
    <div class="col-12 ">
        {!! Form::label('audiences_users', 'Advogados', ['class' => 'control-label']); !!}
        <div class="form-group">
            <select class="form-control" name="audiences_users[]" id="audiences_users" multiple>
                @foreach($users as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="form-group label-float">
            {!! Form::text('audiences_title', null, ['class' => 'form-control',  'placeholder' => ' ', 'id' => 'audiences_title']) !!}
            {!! Form::label('audiences_title', 'O que a pessoa irá fazer?', ['class' => 'control-label']); !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::label('audiences_start', 'Data Início', ['class' => 'control-label']); !!}
            <br>
            <input type="datetime-local" class="form-control" name="audiences_start" id="audiences_start">
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            {!! Form::label('audiences_end', 'Data Fim', ['class' => 'control-label']); !!}
            <br>
            <input type="datetime-local" class="form-control" name="audiences_end" id="audiences_end">
        </div>
    </div>

</div>


<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::textarea('audiences_description', null, ['class' => 'form-control', 'placeholder' => 'Detalhes', 'id' => 'audiences_description', 'cols' => 20, 'rows' => 3]) !!}
        </div>
    </div>
</div>
