@can('update_phase')
    <a href="{{route('phases.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_phase')
    <a href="{{route('phases.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
