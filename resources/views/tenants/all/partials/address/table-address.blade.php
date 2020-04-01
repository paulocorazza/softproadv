<table class="table table-hover" id="address_table">
    <thead>
    <tr>
        <th width="12%">Tipo</th>
        <th width="24%">Rua</th>
        <th width="5%">Número</th>
        <th width="16%">Bairro</th>
        <th width="20%">Cidade</th>
        <th width="8%">UF</th>
        <th width="20%" scope="col">Cep</th>
        <th>Ação</th>
    </tr>
    </thead>

    <tbody class="j_list">
    <!-- /foreach addresses -->
    @if(isset($addresses))
        @forelse($addresses as $address)
            <tr data-id="{{ $address['id'] }}" id="addresses{{ $address['id'] }}">
                <td>
                    <input type="hidden"
                           name="addresses[{{ $address['id'] }}][id]"
                           value="{{ $address['id'] }}">

                    <input type="hidden"
                           name="addresses[{{ $address['id'] }}][complement]"
                           value="{{ $address['complement'] }}">

                    <input type="hidden"
                           name="addresses[{{ $address['id'] }}][country_id]"
                           value="{{ $address['country_id'] }}">


                    <select class="form-control"
                            readonly
                            name="addresses[{{ $address['id'] }}][type_address_id]">
                        <option
                            value="{{ $address['type_address_id'] }}"> {{ $address['type_address']['description'] }}</option>
                    </select>

                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="addresses[{{ $address['id'] }}][street]"
                           value="{{ $address['street'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="addresses[{{ $address['id'] }}][number]"
                           value="{{ $address['number'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="addresses[{{ $address['id'] }}][district]"
                           value="{{ $address['district'] }}">
                </td>



                <td>
                    <select class="form-control"
                            readonly
                            name="addresses[{{ $address['id'] }}][city_id]">
                        <option
                            value="{{ $address['city_id'] }}"> {{ $address['city']['name'] }}</option>
                    </select>
                </td>

                <td>
                    <select class="form-control"
                            readonly
                            name="addresses[{{ $address['id'] }}][state_id]">
                        <option
                            value="{{ $address['state_id'] }}"> {{ $address['state']['initials'] }}</option>
                    </select>
                </td>


                <td>
                    <input class="form-control" readonly type="text"
                           name="addresses[{{ $address['id'] }}][cep]"
                           value="{{ $address['cep'] }}">
                </td>



                <td>
                    <a rel="{{ $address['id'] }}" class="badge bg-yellow" href="javascript:;"
                       onclick="editAddress(this)">Editar</a>

                    <a rel="{{ $address['id'] }}" class="badge bg-danger" href="javascript:;"
                       onclick="removeAddress(this)">Excluir</a>
                </td>
            </tr>
        @empty
            <tr>
               <td colspan="8">Nenhum Endereço Adicionado</td>
            </tr>
        @endforelse
    @endif
    <!-- /.end foreach addresses -->

    </tbody>
</table>
