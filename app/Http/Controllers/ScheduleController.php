<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function loadEvents(Request $request)
    {
        $start = (!empty($request->start) ? ($request->start) : (''));
        $end = (!empty($request->end) ? ($request->end) : (''));

        $events = Schedule::with(['users', 'process'])
                         ->whereBetween('start', [$start, $end])
                         ->schedule()
                         ->get();

        return response()->json($events);
    }

    public function store(ScheduleRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        $data['schedule'] = true;

        $event = Schedule::create($data);

        if (isset($data['users'])) {
            $event->users()->sync($data['users']);
        }


        if ($event) {
            return response()->json(true);
        }
    }

    public function update(ScheduleRequest $request)
    {
        $event = Schedule::find($request->id);

        $data = $request->all();

        $update = $event->update($data);

        if (isset($data['users'])) {
            $event->users()->sync($data['users']);
        }

        if ($update) {
            return response()->json(true);
        }
    }

    public function destroy(Request $request)
    {
       $delete =  Schedule::find($request->id)->delete();

        if ($delete) {
            return response()->json(true);
        }
    }
}
