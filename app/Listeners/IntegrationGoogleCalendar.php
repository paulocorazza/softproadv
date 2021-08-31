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
     * @return void
     */
    public function handle(CreateUpdateEvent $createUpdateEvent)
    {
        $event = $createUpdateEvent->event;

        if (Auth::user()->hasGoogleCalendar() && $event->hasSchedule() && $event->hasGoogleIntegration()) {
            $googleEvent = EventGoogle::find($event->id_google_calendar);

          return $this->syncGoogleCalendar($event, $googleEvent);
        }

        if (Auth::user()->hasGoogleCalendar() && $event->hasSchedule()) {
            $googleEvent = new EventGoogle;
            $googleEvent = $this->syncGoogleCalendar($event, $googleEvent);

            $event->id_google_calendar = $googleEvent->id;
        }
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

/*        foreach ($event->users as $user) {
            $googleEvent->addAttendee([
                'email' => $user->email,
                'name' => $user->name,
            ]);
        }*/

        return $googleEvent->save();

    }
}
