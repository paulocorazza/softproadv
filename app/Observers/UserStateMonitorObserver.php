<?php

namespace App\Observers;

use App\Events\CreateUserStateMonitor;
use App\Models\UserStateMonitor;

class UserStateMonitorObserver
{
    public function created(UserStateMonitor $stateMonitor)
    {
        event(new CreateUserStateMonitor($stateMonitor));
    }
}
