@can('update_stick')
    <a href="{{route('sticks.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_stick')
    <a href="{{route('sticks.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
