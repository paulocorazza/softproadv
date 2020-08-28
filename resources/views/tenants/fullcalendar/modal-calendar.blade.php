<!-- Modal -->
<div class="modal fade" id="modalCalendar" tabindex="-1" role="dialog" aria-labelledby="titleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModal">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="message"></div>

                <form action="" id="formEvent">
                    <input type="hidden" id="id" name="id">

                    <div class="form-group row">
                        <label for="users" class="col-sm-4 col-form-label">Advogados</label>
                        <div class="col-sm-8">
                            <select id="users" multiple class="select" style="width:100%" name="users">
                                @foreach($users as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="process_id" class="col-sm-4 col-form-label">Processo</label>
                        <div class="col-sm-8">
                            <select id="process_id" class="select" style="width:100%" name="process_id">
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label">Titulo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="start" class="col-sm-4 col-form-label">Data/hora Inicial</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control date-time" id="start" name="start">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="end" class="col-sm-4 col-form-label">Data/hora Final</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control date-time" id="end" name="end">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="color" class="col-sm-4 col-form-label">Cor do Evento</label>
                        <div class="col-sm-8">
                            <input type="color" class="form-control" id="color" name="color">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-form-label">Descrição</label>
                        <div class="col-sm-8">
                            <textarea name="description" id="description" cols="40" rows="4"></textarea>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-danger deleteEvent">Excluir</button>
                <button type="button" class="btn btn-primary saveEvent">Salvar</button>
            </div>
        </div>
    </div>
</div>


