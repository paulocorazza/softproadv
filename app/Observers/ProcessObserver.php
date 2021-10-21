<?php

namespace App\Observers;

use App\Models\Process;

class ProcessObserver
{
    public function creating(Process $process)
    {
        $process->user_id = auth()->user()->id;
        $process->monitoring = false;

        $this->canceled($process);
    }

    public function updating(Process $process)
    {
        $this->canceled($process);
    }

    private function canceled(Process $process)
    {
        if (!$process->isCanceled()) {
            $process->canceled_at = null;
            return;
        }

        $process->canceled_at = now();


    }
}
