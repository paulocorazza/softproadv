<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Event;
use App\Models\Financial;
use App\Models\Person;
use App\Models\Process;
use App\Models\ProcessProgress;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Reports\FinancialCharts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class HomeController extends Controller
{

    private $perPage = 20;

    public function __construct(
        private Process $process,
        private ProcessProgress $progress,
        private Event $event,
        private UserRepositoryInterface $user
    ) {

    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('events')) {
                $myEvents = $this->event
                    ->whereHas('users', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })
                    ->notAudience()
                    ->pending()
                    ->latest('start')
                    ->simplePaginate(5);

                return View::make('tenants.home._partials.events', compact('myEvents'))->render();
            }

            if ($request->has('audiences')) {

                $myAudiences = $this->event
                    ->whereHas('users', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })
                    ->audience()
                    ->pending()
                    ->latest('start')
                    ->simplePaginate(5);

                return View::make('tenants.home._partials.audiences', compact('myAudiences'))->render();
            }

            if ($request->has('progress')) {

                $progresses = $this->getProgress();

                return View::make('tenants.home._partials.progress', compact('progresses'))->render();
            }
        }

        $progresses = $this->getProgress();

        $myEvents = $this->event
            ->whereHas('users', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->latest('start')
            ->pending()
            ->notAudience()
            ->simplePaginate(5);


        $myAudiences = $this->event
            ->whereHas('users', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->latest('start')
            ->pending()
            ->audience()
            ->simplePaginate(5);

        $home = true;

        $users = $this->user->getAdvogados();

        return view('tenants.home.index',
            compact( 'progresses', 'myEvents', 'myAudiences', 'users', 'home'));
    }

    /**
     * @return mixed
     */
    private function getProgress()
    {
        return $this->progress
            ->with('process.person')
            ->pending()
            ->oldest('date_term')
            ->simplePaginate($this->perPage);
    }


}
