@if(isset($home))
    <div class="alert alert-warning" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-exclamation"></i> Atenção!</h4>
        <div id="warning"></div>
    </div>


    <div class="row">
        <div class="col-12">
            {!! Form::label('process_id', 'Processo', ['class' => 'control-label']); !!}
            <div class="form-group">
                {!! Form::select('process_id', [], null, ['placeholder' => 'Selecione o Processo', 'class' => 'form-control',  'id' => 'process_id']) !!}
            </div>
        </div>
    </div>

    <input type="hidden" value="" id="id_progress">
@endif
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('process_category', 'Categoria', ['class' => 'control-label']); !!}
            {!! Form::select('process_category', \App\Support\Enum\ProgressCategoriesEnum::PROGRESS_CATEGORIES, ['Outros'], ['class' => 'form-control',  'id' => 'process_category']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            <input id="progress_date" name="progress_date" class="form-control" type="date"
                    placeholder=" " autofocus>
            <label for="progress_date">Data</label>
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="form-group label-float ">
            <input id="progress_description" name="progress_description" class="form-control" type="text"
                    placeholder=" ">
            <label for="progress_description">Descrição</label>
        </div>
    </div>


    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            <input id="progress_date_term" name="progress_date_term" class="form-control" type="date"
                  placeholder=" " autofocus>
            <label for="progress_date_term">Prazo</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::textarea('progress_publication', null, ['class' => 'form-control', 'placeholder' => 'Publicação', 'id' => 'progress_publication', 'cols' => 20, 'rows' => 6]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="icheck-primary d-inline">
            <input id="progress_concluded" name="progress_concluded" type="checkbox">
            <label for="progress_concluded">Concluído</label>
        </div>
    </div>
</div>





