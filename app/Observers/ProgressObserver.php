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
}
