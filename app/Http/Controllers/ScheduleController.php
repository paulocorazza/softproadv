<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function loadEvents(Request $request)
    {
        $returnedColumns = ['id', 'title', 'start', 'end', 'color', 'description'];

        $start = (!empty($request->start) ? ($request->start) : (''));
        $end = (!empty($request->end) ? ($request->end) : (''));

        $events = Event::whereBetween('start', [$start, $end])
                         ->schedule()
                         ->get($returnedColumns);

        return response()->json($events);
    }

    public function store(ScheduleRequest $request)
    {
        $event = Event::create($request->all());

        if ($event) {
            return response()->json(true);
        }
    }

    public function update(ScheduleRequest $request)
    {
        $event = Event::find($request->id);

        $update = $event->update($request->all());

        if ($update) {
            return response()->json(true);
        }
    }

    public function destroy(Request $request)
    {
       $delete =  Event::find($request->id)->delete();

        if ($delete) {
            return response()->json(true);
        }
    }
}
