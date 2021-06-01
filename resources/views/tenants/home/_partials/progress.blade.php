<div class="card-header border-0">
    <h3 class="card-title">Processos / Andamentos</h3>
    <div class="card-tools" id="links_progress">
        {!! $progresses->links() !!}
    </div>
</div>
<div class="card-body table-responsive p-0">
    <table class="table table-striped table-valign-middle">
        <thead>
        <tr>
            <th>Processo</th>
            <th>Data</th>
            <th>Publicação</th>
            <th>Prazo</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($progresses as $progress)
            <tr>
                <td>{{ $progress->process->number_process }}</td>
                <td>{{ $progress->date_br }}</td>
                <td>{{ $progress->description }}</td>
                <td>{{ $progress->date_term_br }}</td>
                <td>
                    <a href="{{ route('processes.show', $progress->process->id) }}" class="text-muted">
                        <i class="fas fa-search"></i>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>


