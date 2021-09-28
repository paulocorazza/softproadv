<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcessSync extends Controller
{
    public function __invoke(\App\Models\Process $process, Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id'             => 'required',
            'number_process' => 'required'
        ]);

        if ($validate->fails()) {
            return implode($validate->messages()->all("<p>:message</p>"));
        }

        $process = $process::findOrFail($request->get('id'));

        $number_process = $request->get('number_process');

        $process->update([
            'number_process' => $number_process
        ]);

        return response()->json($process);
    }
}
