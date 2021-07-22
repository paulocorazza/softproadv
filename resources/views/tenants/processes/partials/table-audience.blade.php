<table class="table table-hover" id="progress_table">
    <thead>
    <tr>
        <th>Título</th>
        <th>Data Início</th>
        <th>Data Fim</th>
        <th width="50px" scope="col"></th>
    </tr>
    </thead>

    <tbody class="j_list">
    <!-- /foreach progresses -->

    @if(isset($events))
        @forelse($events as $event)
            <tr data-id="{{ $event['id']  }}" id="audiences{{ $event['id'] }}">
                <td>
                    <input type="hidden"
                           name="audiences[{{ $event['id']  }}][id]"
                           id="audiences[{{ $event['id']  }}][id]"
                           value="{{ $event['id'] }}">

                    <input type="hidden"
                           name="audiences[{{ $event['id']  }}][color]"
                           id="audiences[{{ $event['id']  }}][color]"
                           value="{{ $event['color'] }}">

                    <input type="hidden"
                           name="audiences[{{ $event['id']  }}][publication]"
                           id="audiences[{{ $event['id']  }}][publication]"
                           value="{{ $event['publication'] }}">

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
                    <input class="form-control" readonly type="checkbox"
                           name="audiences[{{ $event['id'] }}][concluded]"
                           id="audiences[{{ $event['id'] }}][concluded]" {{ $event['concluded'] ? 'checked' : '' }} >
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
