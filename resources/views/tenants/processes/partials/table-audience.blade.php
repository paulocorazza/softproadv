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

    @if(isset($progresses))
        @forelse($progresses as $progress)
            <tr data-id="{{ $progress['id']  }}" id="progresses{{ $progress['id'] }}">
                <td>
                    <input type="hidden"
                           name="progresses[{{ $progress['id']  }}][id]"
                           id="progresses[{{ $progress['id']  }}][id]"
                           value="{{ $progress['id'] }}">

                    <input type="hidden"
                           name="progresses[{{ $progress['id']  }}][publication]"
                           id="progresses[{{ $progress['id']  }}][publication]"
                           value="{{ $progress['publication'] }}">

                    <input class="form-control" readonly type="text"
                           name="progresses[{{ $progress['id']  }}][date]"
                           id="progresses[{{ $progress['id']  }}][date]"
                           value="{{ $progress['date_br']  }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="progresses[{{ $progress['id']  }}][description]"
                           id="progresses[{{ $progress['id']  }}][description]"
                           value="{{ $progress['description'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="text"
                           name="progresses[{{ $progress['id'] }}][date_term]"
                           id="progresses[{{ $progress['id'] }}][date_term]"
                           value="{{ $progress['date_term_br'] }}">
                </td>

                <td>
                    <input class="form-control" readonly type="checkbox"
                           name="progresses[{{ $progress['id'] }}][concluded]"
                           id="progresses[{{ $progress['id'] }}][concluded]" {{ $progress['concluded'] ? 'checked' : '' }} >
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
