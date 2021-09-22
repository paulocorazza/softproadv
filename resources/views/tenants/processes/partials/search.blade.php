<form action="#" class="form" id="form_search">
    <div class="row">
        <div class="col-sm-2 col-12">
            <div class="form-group">
                <select name="status" id="status" class="form-control change">
                    <option value="" selected>Todos</option>
                    <option value="Em Andamento">Em Andamento</option>
                    <option value="Concluído">Concluído</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4 col-12">
            <div class="form-group">
                <select style="width: 100%" name="users" id="users" class="form-control change" multiple="multiple">
                    @foreach($users as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-4 col-12">
            <div class="btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary">
                    <i class="fas fa-wifi"></i>
                    <input type="checkbox" class="change" name="monitoring" id="monitoring"  autocomplete="off">
                </label>
            </div>
        </div>
    </div>
</form>


