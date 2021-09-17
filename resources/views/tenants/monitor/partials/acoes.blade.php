<form action="{{route('monitor.published')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <button type="submit" class="badge bg-yellow">Publicar</button>
</form>

<form action="{{route('monitor.archived')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $id }}">
    <button type="submit" class="badge bg-dark">Arquivar</button>
</form>
