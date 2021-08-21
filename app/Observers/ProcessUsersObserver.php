<?php

namespace App\Observers;

use App\Models\ProcessUsers;
use App\Notifications\UserLinkedProcess;

class ProcessUsersObserver
{
    public function created(ProcessUsers $processUsers)
    {
        $user = $processUsers->user;
        $process = $processUsers->process;

        $user->notify(new UserLinkedProcess($user->uuid, $process));
    }
}
