@can('update_district')
    <a href="{{route('districts.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_district')
    <a href="{{route('districts.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan

<a href="{{route('districts.sticks', $id)}}" class="badge bg-cyan">Varas</a>

