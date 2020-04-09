@can('update_stage')
    <a href="{{route('stages.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_stage')
    <a href="{{route('stages.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
