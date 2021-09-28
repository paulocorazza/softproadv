<?php

namespace App\Observers;

use App\Events\CreateUserStateMonitor;
use App\Models\UserStateMonitor;

class UserStateMonitorObserver
{
    public function created(UserStateMonitor $stateMonitor)
    {
        $company = [];

        if (session()->has('company')) {
            $company = session('company');
        }

        event(new CreateUserStateMonitor($stateMonitor, $company));
    }
}
