<table class="table table-hover" id="contact_table">
    <thead>
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Celular</th>
        <th>E-mail</th>
        <th width="50px" scope="col">Ação</th>
    </tr>
    </thead>

    <tbody class="j_list">
    <!-- /foreach contacts -->

    @if(old('contacts'))
        @php
            $contacts = old('contacts');
        @endphp
    @endif

    @if(isset($contacts))
        @forelse($contacts as $contact)
            <tr data-id="{{ $contact['id']  }}" id="contacts{{ $contact['id'] }}">
                <td>
                    <input type="hidden"
                           name="contacts[{{ $contact['id']  }}][id]"
                           value="{{ $contact['id'] }}">

                    <input class="form-control" readonly type="text"
                           name="contacts[{{ $contact['id']  }}][name]"
                           value="{{ $contact['name']  }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="contacts[{{ $contact['id']  }}][telephone]"
                           value="{{ $contact['telephone'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="contacts[{{ $contact['id'] }}][cellphone]"
                           value="{{ $contact['cellphone'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="contacts[{{ $contact['id'] }}][email]"
                           value="{{ $contact['email'] }}">
                </td>


                <td>
                    <a rel="{{ $contact['id'] }}" class="badge bg-yellow" href="javascript:;"
                       onclick="editDetail(this)">Editar</a>

                    <a rel="{{$contact['id'] }}" class="badge bg-danger" href="javascript:;"
                       onclick="removeDetail(this)">Excluir</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nenhum Contato Adicionado</td>
            </tr>
        @endforelse
    @endif


    <!-- /.end foreach addresses -->

    </tbody>
</table>
