<table class="table table-hover" id="progress_table">
    <thead>
    <tr>
        <th>Data</th>
        <th>Descrição</th>
        <th>Prazo</th>
        <th>Pendente</th>
        <th width="50px" scope="col">Ação</th>
    </tr>
    </thead>

    <tbody class="j_list">
    <!-- /foreach progresses -->

    @if(isset($progresses))
        @forelse($progresses as $progress)
            <tr data-id="{{ $progress['id']  }}" id="progresses{{ $progress['id'] }}">
                <td>
                    <input type="hidden"
                           name="progresses[{{ $progress['id']  }}][id]"
                           value="{{ $progress['id'] }}">

                    <input type="hidden"
                           name="progresses[{{ $progress['id']  }}][publication]"
                           value="{{ $progress['publication'] }}">

                    <input class="form-control" readonly type="text"
                           name="progresses[{{ $progress['id']  }}][created_at]"
                           value="{{ $progress['created_at']  }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="progresses[{{ $progress['id']  }}][description]"
                           value="{{ $progress['description'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="progresses[{{ $progress['id'] }}][date_term]"
                           value="{{ $progress['date_term'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="progresses[{{ $progress['id'] }}][pending]"
                           value="{{ $progress['pending'] }}">
                </td>


                <td>
                    <a rel="{{ $progress['id'] }}" class="badge bg-yellow" href="javascript:;"
                       onclick="editDetail(this)">Editar</a>

                    <a rel="{{$progress['id'] }}" class="badge bg-danger" href="javascript:;"
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
