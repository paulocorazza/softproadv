<div class="card-header border-0">
    <h3 class="card-title">Processos / Andamentos</h3>
    <div class="card-tools" id="links_progress">
        <div class="pagination pagination-sm">{!! $progresses->links() !!}</div>
    </div>
</div>
<div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle">
        <thead>
        <tr>
            <th>Prazo</th>
            <th>Processo</th>
            <th>Publicação</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($progresses as $progress)
            @if(isset($progress->process))
                <tr>
                    <td>{{ $progress->date_term_br }}</td>
                    <td>{{ $progress->process->number_process }}</td>
                    <td>{{ $progress->description }}</td>
                    <td>
                        <a href="{{ route('processes.show', $progress->process->id) }}" class="text-muted">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>


