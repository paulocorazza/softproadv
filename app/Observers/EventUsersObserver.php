<?php

namespace App\Observers;

use App\Models\EventUsers;
use App\Notifications\UserLinkedEvent;

class EventUsersObserver
{
    public function created(EventUsers $eventUsers)
    {
        $user = $eventUsers->user;
        $event = $eventUsers->event;

        $user->notify(new UserLinkedEvent($event, $user->uuid));
    }
}
