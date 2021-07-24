<?php

namespace App\Http\Controllers\ExtraAction;

use App\Http\Controllers\Controller;
use App\Models\Event;

class ProcessAudienceDestroy extends Controller
{
    public function __invoke(Event $event)
    {
        if (request()->ajax()) {
            $id = request()->get('id');

            $event = $event->find($id);

            if ($event) {
                $event->delete();

                return response()->json(['result' => true]);
            }
        }
    }
}
