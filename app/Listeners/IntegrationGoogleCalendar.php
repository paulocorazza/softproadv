<?php

namespace App\Listeners;

use App\Events\CreateUpdateEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event as EventGoogle;

class IntegrationGoogleCalendar
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return EventGoogle
     */
    public function handle(CreateUpdateEvent $createUpdateEvent)
    {
        $event = $createUpdateEvent->event;

        if ($this->hasIntegration($event)) {
            $googleEvent = EventGoogle::find($event->id_google_calendar);

          return $this->syncGoogleCalendar($event, $googleEvent);
        }

        if ($this->isEventCalendar($event)) {
            $googleEvent = new EventGoogle;
            $googleEvent = $this->syncGoogleCalendar($event, $googleEvent);

           return $event->id_google_calendar = $googleEvent->id;
        }
    }

    /**
     * @param Event $event
     * @return bool
     */
    private function hasIntegration(Event $event): bool
    {
        return $this->isEventCalendar($event) && $event->hasGoogleIntegration();
    }

    /**
     * @param Event $event
     * @return bool
     */
    private function isEventCalendar(Event $event): bool
    {
        return Auth::user()->hasGoogleCalendar() && $event->isSchedule();
    }

    /**
     * @param Event $event
     * @param EventGoogle $googleEvent
     */
    private function syncGoogleCalendar(Event $event, EventGoogle $googleEvent): EventGoogle
    {
        $googleEvent->name = $event->title;
        $googleEvent->description = $event->description;
        $googleEvent->startDateTime = Carbon::parse($event->start);
        $googleEvent->endDateTime = Carbon::parse($event->end);

        return $googleEvent->save();
    }
}
