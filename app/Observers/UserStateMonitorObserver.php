<?php

namespace App\Observers;

use App\Events\CreateUserStateMonitor;
use App\Models\UserStateMonitor;
use App\Tenant\ManagerTenant;

class UserStateMonitorObserver
{
    public function created(UserStateMonitor $stateMonitor)
    {
       $manager = app(ManagerTenant::class);

       event(new CreateUserStateMonitor($stateMonitor, $manager->getTokenJuzBrazil()));
    }
}
