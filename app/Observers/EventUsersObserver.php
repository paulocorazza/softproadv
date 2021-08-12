<?php

namespace App\Observers;

use App\Models\EventUsers;
use App\Notifications\UserLinkedEvent;

class EventUsersObserver
{
    public function created(EventUsers $eventUsers)
    {
        $user = $eventUsers->user()->first();
        $event = $eventUsers->event()->first();

        $user->notify(new UserLinkedEvent($user, $event));
    }
}
