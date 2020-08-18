<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\ProcessProgress;
use Illuminate\Http\Request;

class ProcessProgressDestroy extends Controller
{
    public function __invoke(ProcessProgress $progress)
    {
        if (request()->ajax()) {
            $id = request()->get('id');

            $progress = $progress->find($id);

            if ($progress) {
                $progress->delete();

                return response()->json(['result' => true]);
            }
        }
    }
}
