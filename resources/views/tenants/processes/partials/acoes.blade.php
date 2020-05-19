@can('update_process')
    <a href="{{route('processes.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_process')
    <a href="{{route('processes.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
