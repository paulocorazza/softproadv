<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->salary = $user->salary ?? 0;
    }

    public function updating(User $user)
    {
        $user->salary = $user->salary ?? 0;
    }
}
