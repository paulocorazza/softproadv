<?php

namespace App\Observers;

use App\Events\CreateUpdateEvent;
use App\Models\Event;
use Spatie\GoogleCalendar\Event as EventGoogle;

use Illuminate\Support\Facades\Auth;

class EventObserver
{
    public function creating(Event $event)
    {
        event(new CreateUpdateEvent($event));
    }

    public function updating(Event $event)
    {
        event(new CreateUpdateEvent($event));
    }

    public function deleting(Event $event)
    {
        if (Auth::user()->hasGoogleCalendar() && $event->isSchedule() && $event->hasGoogleIntegration()) {
            $googleEvent = EventGoogle::find($event->id_google_calendar);
            $googleEvent->delete();
        }
    }


}
