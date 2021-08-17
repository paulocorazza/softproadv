<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function creating(User $user)
    {
        $user->salary = $user->salary ?? 0;
        $user->uuid = Str::uuid();
    }

    public function updating(User $user)
    {
        $user->salary = $user->salary ?? 0;
    }
}
