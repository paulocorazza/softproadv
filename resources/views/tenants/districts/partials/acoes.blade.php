@can('update_district')
    <a href="{{route('districts.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_district')
    <a href="{{route('districts.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
