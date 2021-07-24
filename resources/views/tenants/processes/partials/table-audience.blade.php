<table class="table table-hover" id="audiences_table">
    <thead>
    <tr>
        <th>Título</th>
        <th>Data Início</th>
        <th>Data Fim</th>
        <th width="50px" scope="col"></th>
    </tr>
    </thead>

    <tbody class="j_list">
    <!-- /foreach audiencese -->

    @if(isset($events))
        @forelse($events as $event)
            <tr data-id="{{ $event['id']  }}" id="audiences{{ $event['id'] }}">
                <td>
                    <select hidden name="audiences[{{ $event['id']  }}][users][]" id="users_audience{{$event['id']}}" multiple aria-hidden="true">
                        @foreach($event->users as $user)
                            <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    <input type="hidden"
                           name="audiences[{{ $event['id']  }}][id]"
                           id="audiences[{{ $event['id']  }}][id]"
                           value="{{ $event['id'] }}">

                    <input type="hidden"
                           name="audiences[{{ $event['id']  }}][description]"
                           id="audiences[{{ $event['id']  }}][description]"
                           value="{{ $event['description'] }}">

                    <input class="form-control" readonly type="text"
                           name="audiences[{{ $event['id']  }}][title]"
                           id="audiences[{{ $event['id']  }}][title]"
                           value="{{ $event['title']  }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="audiences[{{ $event['id']  }}][start]"
                           id="audiences[{{ $event['id']  }}][start]"
                           value="{{ $event['start_br'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="audiences[{{ $event['id'] }}][end]"
                           id="audiences[{{ $event['id'] }}][end]"
                           value="{{ $event['end_br'] }}">
                </td>


                <td>
                    <a rel="{{ $event['id'] }}" class="badge bg-yellow" href="javascript:;"
                       onclick="editDetailEvent(this)">Editar</a>

                    <a rel="{{$event['id'] }}" class="badge bg-danger" href="javascript:;"
                       onclick="removeDetailEvent(this)">Excluir</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nenhuma Audiência Adicionada</td>
            </tr>
        @endforelse
    @endif


    <!-- /.end foreach addresses -->

    </tbody>
</table>
