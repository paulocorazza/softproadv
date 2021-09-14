<?php

namespace App\Observers;

use App\Models\Process;

class ProcessObserver
{
    public function creating(Process $process)
    {
        $process->user_id = auth()->user()->id;
        $process->monitoring = false;
    }
}
