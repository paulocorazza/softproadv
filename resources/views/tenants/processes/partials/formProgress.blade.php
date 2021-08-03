<div class="row">
    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            <input id="progress_date" name="progress_date" class="form-control" type="date"
                   class="form-control" placeholder=" " autofocus>
            <label for="progress_date">Data</label>
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="form-group label-float ">
            <input id="progress_description" name="progress_description" class="form-control" type="text"
                   class="form-control" placeholder=" ">
            <label for="progress_description">Descrição</label>
        </div>
    </div>


    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            <input id="progress_date_term" name="progress_date_term" class="form-control" type="date" class="form-control" placeholder=" " autofocus>
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





