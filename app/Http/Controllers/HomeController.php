<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Person;
use App\Models\Process;
use App\Models\ProcessProgress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class HomeController extends Controller
{

    private $perPage = 10;

    public function __construct(private Process $process, private ProcessProgress $progress, private Person $person, private Event $event, private User $user)
    {

    }


    public function index(Request $request)
    {
        $totalProcesses = $this->process->count();
        $totalInProgress = $this->progress->pending()->count();


        $countEvent = $this->event->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->count();

        $totalEvents = $countEvent > 0 ? ($this->event->whereHas('users', function ($query) {
            $query->where('user_id', Auth::user()->id);
        })->finish()->count() / $countEvent) * 100 : 100 ;


        if ($request->ajax()) {
            if ($request->has('events')) {

                $myEvents = $this->event->pending()->paginate($this->perPage);

                return View::make('tenants.home.index._partials.events', compact('myEvents'))->render();
            }

            if ($request->has('progress')) {

                $progresses = $this->getProgress();

                return View::make('tenants.home._partials.progress', compact('progresses'))->render();
            }
        }

        $progresses = $this->getProgress();

        $myEvents  = $this->event
                          ->whereHas('users', function ($query) {
                              $query->where('user_id', Auth::user()->id);
                          })
                         ->pending()
                         ->paginate($this->perPage);

        return view('tenants.home.index', compact('totalProcesses', 'totalInProgress',  'totalEvents', 'progresses', 'myEvents'));
    }

    /**
     * @return mixed
     */
    private function getProgress()
    {
        return $this->progress
            ->with('process')
            ->pending()
            ->latest('date_term')
            ->paginate($this->perPage);
    }


}
