<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {

        $this->user = $user;
    }


    public function index(Request $request)
    {
        $title = 'Agenda';

        $users = $this->user->getAdvogados();

       // $start = (!empty($request->start) ? ($request->start) : (''));
       // $end = (!empty($request->end) ? ($request->end) : (''));
        $user_id = (!empty($request->userselect) ? ($request->userselect) : (auth()->user()->id));

        $events = Schedule::with(['users', 'process'])
           // ->whereBetween('start', [$start, $end])
            ->where('user_id', $user_id)
            ->schedule()
            ->get();


        return view('tenants.fullcalendar.master', compact('title', 'users', 'events'));
    }


/*    public function loadEvents(Request $request)
    {

      dd($request->all());

        $start = (!empty($request->start) ? ($request->start) : (''));
        $end = (!empty($request->end) ? ($request->end) : (''));


        $user_id = (!empty($request->user_id) ? ($request->user_id) : (auth()->user()->id));

        $events = Schedule::with(['users', 'process'])
                         ->whereBetween('start', [$start, $end])
                         ->where('user_id', $user_id)
                         ->schedule()
                         ->get();

        return response()->json($events);
    }*/

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
