@can('update_financial_category')
    <a href="{{route('financial-category.edit', $id)}}" class="badge bg-yellow">Editar</a>
@endcan

@can('view_financial_category')
    <a href="{{route('financial-category.show', $id)}}" class="badge bg-dark">Detalhes</a>
@endcan
