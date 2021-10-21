<?php

namespace App\Rules;

use App\Models\Monitor;
use App\Models\Process;
use Illuminate\Contracts\Validation\Rule;

class LimitStartMonitor implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $limit = session('company')['plan']->processes_count_search ?? 1;

        $processMonitored = Process::monitoring()->count();

        $monitoredMonth = Monitor::process()
            ->select('process_id')
            ->whereMonth('created_at', now())
            ->groupBy('process_id')
            ->get();

        return $this->hasLimit($limit, $processMonitored, count($monitoredMonth));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Limite processos monitorados atingido.';
    }

    private function hasLimit(int $limit, int $processMonitored, int $monitoredMonth) : bool
    {
        if (($processMonitored == $limit) || ($monitoredMonth == $limit))
         return false;

        return true;
    }
}
