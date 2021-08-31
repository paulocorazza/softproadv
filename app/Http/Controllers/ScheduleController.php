<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Event;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->middleware('google.calendar');

        $this->user = $user;
    }


    public function index(Request $request)
    {
        $title = 'Agenda';

        $user = auth()->user();

        $users = $this->user->getUsersView($user->id);

        if (Session::has('userFilter')) {
            Session::forget('userFilter');
        }

          return view('tenants.fullcalendar.master', compact('title', 'users'));
    }

    public function loadUser(Request $request)
    {
        $user = $request->user_id;

        $request->session()->put('userFilter', $user);

        return response()->json(true);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
   public function loadEvents(Request $request)
    {
        $start = (!empty($request->start) ? ($request->start) : (''));
        $end = (!empty($request->end) ? ($request->end) : (''));

        $userFilter = '';

        if (Session::has('userFilter')) {
            $userFilter = Session::get('userFilter');
        }

        $user_id = (!empty($userFilter) ? ($userFilter) : (auth()->user()->id));

        $events = Event::with(['users', 'process'])
            ->whereHas('users', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
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
        $data['audience'] = false;

        $event = Event::create($data);

        if (isset($data['users'])) {
            $event->users()->sync($data['users']);
        }


        if ($event) {
            return response()->json(true);
        }
    }

    public function update(ScheduleRequest $request)
    {
        $event = Event::find($request->id);

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
       $delete =  Event::find($request->id)->delete();

        if ($delete) {
            return response()->json(true);
        }
    }
}
