<table class="table table-hover" id="files_table">
    <thead>
    <tr>
        <th>Descrição</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="j_lits">
    @if(isset($files))
        @forelse($files as $file)
            <tr>
                <td>{{ $file->description }}</td>
                <td class="text-right py-0 align-middle">
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('fileDownload', $file->id) }}"  class="btn btn-primary"><i class="fas fa-download"></i></a>

                        <a href="{{ route('fileView', $file->id) }}" target="_blank" class="btn btn-info"><i class="fas fa-eye"></i></a>

                        <a href="javascript:;" data-id ="{{$file->id}}" onclick="removeFile(this)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Nenhum Contato Adicionado</td>
            </tr>
        @endforelse

    @endif


    </tbody>
</table>


