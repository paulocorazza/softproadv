<?php

namespace App\Listeners;

use App\Events\CreateUserStateMonitor;
use App\Services\MonitorPusherService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePusherUserState implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private MonitorPusherService $monitorService)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreateUserStateMonitor  $event
     * @return void
     */
    public function handle(CreateUserStateMonitor $event)
    {
        $userState = $event->stateMonitor->load('user', 'state');

        $this->monitorService->createPusherOabUserState($userState, $event->tokenJusBrazil);
    }
}
