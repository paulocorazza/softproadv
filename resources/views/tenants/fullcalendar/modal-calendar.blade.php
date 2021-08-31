<!-- Modal -->
<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-inline-flex justify-content-between">
                <div>
                    <h5 class="modal-title" id="titleModal">Modal title</h5>
                </div>
                <div>
                    <button type="button" class="btn btn-primary d-inline saveEvent">Salvar</button>
                    <button type="button" class="btn btn-danger d-inline deleteEvent">Excluir</button>
                    <button type="button" class="btn btn-secondary d-inline" data-dismiss="modal">Fechar</button>
                    <div class="preload">
                        @include('tenants.includes.load')
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div id="message"></div>

                <form id="formEvent">
                    <input type="hidden" id="id" name="id">

                    <div class="form-group row">
                        <label for="users" class="col-sm-4 col-form-label text-right">Advogados</label>
                        <div class="col-sm-8">
                            <select id="users" multiple class="select" style="width:100%" name="users">
                                @foreach($users as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="process_id" class="col-sm-4 col-form-label text-right">Processo</label>
                        <div class="col-sm-8">
                            <select id="process_id" class="select" style="width:100%" name="process_id">
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label text-right">Titulo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="start" class="col-sm-4 col-form-label text-right">Data/hora Inicial</label>
                        <div class="col-sm-8">
                            <input type="datetime-local" class="form-control" name="start" id="start">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="end" class="col-sm-4 col-form-label text-right">Data/hora Final</label>
                        <div class="col-sm-8">
                            <input type="datetime-local" class="form-control" name="end" id="end">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="color" class="col-sm-4 col-form-label text-right">Cor do Evento</label>
                        <div class="col-sm-8">
                            <input type="color" class="form-control" id="color" name="color">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Detalhes', 'id' => 'description', 'cols' => 20, 'rows' => 3]) !!}
                            </div>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
</div>


