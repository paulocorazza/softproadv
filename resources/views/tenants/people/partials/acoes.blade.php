@can('update_person')
    <a href="{{route('people.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_person')
<a href="{{route('people.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan

