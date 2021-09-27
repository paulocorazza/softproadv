<?php

namespace App\Listeners;

use App\Events\CreateUserStateMonitor;
use App\Services\MonitorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePusherUserState
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private MonitorService $monitorService)
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

        $this->monitorService->createPusherUserState($userState);
    }
}
