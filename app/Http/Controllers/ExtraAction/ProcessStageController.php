<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\ProcessStage;

class ProcessStageController extends Controller
{
    public function __invoke(ProcessStage $stage, $id)
    {
        $stage = $stage->findOrFail($id);

        $stage->delete();

        return redirect()->back();
    }
}
