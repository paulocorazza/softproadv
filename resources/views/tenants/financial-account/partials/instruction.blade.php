<div class="wrapper">
    @forelse($instructions as $instruction)
        <div class="toclone">
            <div class="row">
                <div class="col-10">
                    <div class="form-group">
                        <input type="text" class="form-control"
                               name="instructions[{{ $instruction->id }}][instruction]"
                               id="instructions{{ $instruction->id }}"
                               value="{{ $instruction->instruction  }}">
                    </div>
                </div>


                <div class="col-2">
                    <button type="button" class="btn bg-primary" onclick="addFile(this)"> +</button>
                    <button type="button" class="btn bg-danger" onclick="removeFile(this)"> -</button>
                </div>
            </div>
        </div>

    @empty

        <div class="toclone">
            <div class="row">
                <div class="col-10">
                    <div class="form-group">
                        <input type="text" class="form-control" name="instructions[0][instruction]" id="instructions0">
                    </div>
                </div>


                <div class="col-2">
                    <button type="button" class="btn bg-primary" onclick="addFile(this)"> +</button>
                    <button type="button" class="btn bg-danger" onclick="removeFile(this)"> -</button>
                </div>
            </div>
        </div>

    @endforelse


</div>

