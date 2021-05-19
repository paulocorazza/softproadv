<?php

namespace App\Observers;

use App\Models\Financial;

class FinancialObserver
{
    public function creating(Financial $financial)
    {
        $financial->discount = $financial->discount ?? 0;
        $financial->fine = $financial->fine ?? 0;
        $financial->rate = $financial->rate ?? 0;
        $financial->credit = $financial->credit ?? 0;
    }
}
