<?php

namespace App\Observers;

use App\Events\CreateProgressIntegration;
use App\Models\ProcessProgress;

class ProgressObserver
{
    public function creating(ProcessProgress $progress)
    {
        $progress->category = $progress->category ?? 'Outros';
    }

    public function created(ProcessProgress $progress)
    {
        if ($progress->isIntegration()) {
            $companyUuid = session()->has('company') ? session('company')['uuid'] : '';
            broadcast(new CreateProgressIntegration($progress, $companyUuid));
        }
    }
}
