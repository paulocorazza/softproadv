@can('update_state')
    <a href="{{route('states.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_state')
    <a href="{{route('states.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
