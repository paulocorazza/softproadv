<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\ProcessProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function __construct(
        private Process $process,
        private ProcessProgress $progress
    ) {

    }


    public function edit($process)
    {
       $progress = $this->progress->with('process.person')->findOrFail($process);

       return response()->json($progress);
    }

    public function update(Request $request, $id)
    {
        $progress = $this->progress->findOrFail($id);

        $data = $request->all();
        $data['concluded'] = (!empty($data['concluded'])) ? true : false;

        $progress->update($data);

        session()->flash('success', 'Registro atualizado com sucesso!');

        return '1';
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $process = $this->process->findOrFail($data['process_id']);

        $data['concluded'] = (!empty($data['concluded'])) ? true : false;
        $process->progresses()->create($data);

        session()->flash('success', 'Registro realizado com sucesso!');

        return '1';
    }
}
