<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <label for="type_address_id">Tipos de Endereço</label>
            <select id="type_address_id"  class="js-example-responsive" style="width:100%">
                <option value="">Escolha um tipo de endereço</option>
                @foreach($type_addresses as $type)
                    <option value="{{ $type->id }}">{{ $type->description }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <div class="input-group">
                <input id="cep" class="form-control" type="text" class="form-control" placeholder="CEP:">
                <span class="input-group-btn">
                      <button id="search_cep" type="button" class="btn btn-info btn-flat"><i class="fa fa-address-card"
                                                                                             aria-hidden="true"></i></button>
                    </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group">
            <input id="street" class="form-control" type="text" class="form-control" placeholder="Rua:">
        </div>
    </div>

    <div class="col-12 col-sm-2">
        <div class="form-group">
            <input id="number" class="form-control" type="text" class="form-control" placeholder="Número:">
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <input id="district" class="form-control" type="text" class="form-control" placeholder="Bairro:">
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group">
            <input id="complement" class="form-control" type="text" class="form-control" placeholder="Complemento:">
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 col-sm-4">
        <div class="form-group">
            <select id="country_id" class="js-example-responsive" style="width:100%">
                <option value="">Selecione um país</option>
                @foreach($countries as $county)
                    <option value="{{ $county->id }}">{{$county->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-12 col-sm-2">
        <div class="form-group">
            <select id="state_id" class="js-example-responsive" style="width:100%"></select>
        </div>
    </div>


    <div class="col-12 col-sm-6">
        <div class="form-group">
            <select id="city_id" class="js-example-responsive" style="width:100%"></select>
        </div>
    </div>
</div>


