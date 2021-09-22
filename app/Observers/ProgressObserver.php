<?php

namespace App\Observers;

use App\Events\CreateProgressIntegration;
use App\Models\ProcessProgress;
use Illuminate\Support\Facades\Log;

class ProgressObserver
{
    public function creating(ProcessProgress $progress)
    {
        $progress->category = $progress->category ?? 'Outros';
    }

    public function created(ProcessProgress $progress)
    {
        if ($progress->isIntegration()) {
            Log::debug('broadcast');
            $companyUuid = session()->has('company') ? session('company')['uuid'] : '';
            broadcast(new CreateProgressIntegration($progress, $companyUuid));
        }
    }
}
