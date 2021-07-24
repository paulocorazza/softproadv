<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Event;
use App\Models\Financial;
use App\Models\Person;
use App\Models\Process;
use App\Models\ProcessProgress;
use App\Models\User;
use App\Services\Reports\FinancialCharts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use View;

class HomeController extends Controller
{

    private $perPage = 10;

    public function __construct(
        private Process $process,
        private ProcessProgress $progress,
        private Event $event,
        private FinancialCharts $financialCharts
    ) {

    }


    public function index(Request $request)
    {
        $totalProcesses = $this->process->count();
        $totalInProgress = $this->progress->pending()->count();

        $financialChart = $this->financialCharts->getReports();

        $countEvent = $this->event->notAudience()->count();
        $countEventFinish = $this->event->notAudience()->finish()->count();

        $totalEvents =  $countEvent > 0 ? Helper::roundTo(($countEventFinish / $countEvent) * 100) : 100;

        if ($request->ajax()) {
            if ($request->has('events')) {
                $myEvents = $this->event->notAudience()->pending()->paginate($this->perPage);

                return View::make('tenants.home.index._partials.events', compact('myEvents'))->render();
            }

            if ($request->has('audiences')) {

                $myAudiences = $this->event->audience()->pending()->paginate($this->perPage);

                return View::make('tenants.home.index._partials.audiences', compact('myAudiences'))->render();
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
            ->paginate($this->perPage);


        $myAudiences = $this->event
            ->whereHas('users', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->latest('start')
            ->pending()
            ->audience()
            ->paginate($this->perPage);

        return view('tenants.home.index',
            compact('totalProcesses', 'totalInProgress', 'totalEvents', 'progresses', 'myEvents', 'myAudiences', 'financialChart'));
    }

    /**
     * @return mixed
     */
    private function getProgress()
    {
        return $this->progress
            ->with('process')
            ->pending()
            ->oldest('date_term')
            ->paginate($this->perPage);
    }


}
