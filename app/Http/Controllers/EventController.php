<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function loadEvents()
    {
        $events = Event::all();

        return response()->json($events);
    }

    public function update(Request $request)
    {
        $event = Event::find($request->id);

        $update = $event->update($request->all());

        if ($update) {
            return response()->json(true);
        }
    }
}
