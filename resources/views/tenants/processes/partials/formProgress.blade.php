<div class="row">
    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            <input id="progress_created_at" name="progress_created_at" class="form-control" type="date"
                   class="form-control" placeholder=" " autofocus>
            <label for="name">Data</label>
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="form-group label-float">
            <input id="progress_description" name="progress_description" class="form-control" type="text"
                   class="form-control" placeholder=" ">
            <label for="contact_email">Descrição</label>
        </div>
    </div>


    <div class="col-12 col-sm-3">
        <div class="form-group label-float">
            <input id="progress_date_term" name="progress_date_term" class="form-control" type="date"
                   class="form-control" placeholder=" " autofocus>
            <label for="name">Prazo</label>
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
            <input id="progress_pending" name="progress_pending" type="checkbox">
            <label for="progress_pending">Pendente</label>
        </div>
    </div>
</div>





