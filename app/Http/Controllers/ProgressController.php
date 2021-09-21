<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Process;
use App\Models\ProcessProgress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validate = Validator::make($request->all(), $this->progress->rules($id));

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }

        $progress = $this->progress->findOrFail($id);

        $data = $request->all();
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');

        if (isset($data['date_term'])) {
            $data['date_term'] = Carbon::createFromFormat('d/m/Y', $data['date_term'])->format('Y-m-d');
        }

        $data['concluded'] = (!empty($data['concluded'])) ? true : false;

        $progress->update($data);

        session()->flash('success', 'Registro atualizado com sucesso!');

        return '1';
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), $this->progress->rules());

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }


        $data = $request->all();

        $process = $this->process->findOrFail($data['process_id']);

        $data['concluded'] = (!empty($data['concluded'])) ? true : false;
        $data['published_at'] = now();
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');

        if (isset($data['date_term'])) {
            $data['date_term'] = Carbon::createFromFormat('d/m/Y', $data['date_term'])->format('Y-m-d');
        }


        $process->progresses()->create($data);

        session()->flash('success', 'Registro realizado com sucesso!');

        return '1';
    }
}
