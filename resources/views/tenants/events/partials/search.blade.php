<form action="#" class="form" id="form_search">
    <div class="row">
        <div class="col-sm-2 col-12">
            <div class="form-group">
                <select name="status" id="status" class="form-control change">
                    <option value="" selected>Todos</option>
                    <option value="Aberto">Aberto</option>
                    <option value="Finalizado">Finalizado</option>
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
    </div>
</form>


