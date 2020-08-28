@can('update_event')
    <a href="{{route('events.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_event')
    <a href="{{route('events.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
