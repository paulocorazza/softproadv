<div class="card-header ui-sortable-handle" style="cursor: move;">
    <h5 class="d-inline"><strong>Andamentos </strong></h5>
    <div class="card-tools" id="links_progress">
        <div class="pagination pagination-sm">{!! $progresses->links() !!}</div>
    </div>
</div>

<div class="card-body table-responsive p-0">
    <table class="table table-borderless table-hover">
        <thead>
        <tr>
            <th>Prazo</th>
            <th>Cliente</th>
            <th>Processo</th>
            <th>Publicação</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($progresses as $progress)
            @if(isset($progress->process))
                <tr>
                    <td>{{ $progress->date_term_br }}</td>
                    <td>{{ $progress->process->person->name_limit }}</td>
                    <td>{{ $progress->process->number_process }}</td>
                    <td>{{ $progress->description }}</td>
                    <td><small class="badge {{ $progress->color_days_diff }}"><i class="far fa-clock"></i>{{ $progress->days_diff }} dias
                        </small></td>
                    <td>
                        <a data-toggle="modal" data-target=".modal-progress" data-id="{{ $progress->id }}"   href="javascript:;"  onclick="editDetailProgress(this)" class="text-muted">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>


