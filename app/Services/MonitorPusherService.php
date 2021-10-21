<?php

namespace App\Services;

use App\Events\CreateUserStateMonitor;
use App\Models\Monitor;
use App\Models\MonitorProcess;
use App\Models\Process;
use App\Models\ProcessProgress;
use App\Models\UserStateMonitor;
use App\Repositories\Contracts\MonitorInterface;
use App\Repositories\Contracts\XMLImportInterface;
use App\Repositories\Core\JuzBrazil\ProgressBipBopXML;
use App\Tenant\ManagerTenant;

class MonitorPusherService
{

    public function __construct(
        private MonitorInterface $monitor,
        private ImportXmlService $importXmlService
    )
    {

    }

    public function startMonitorProcess(Process $process)
    {
        return $this->createOrEnabledPusher($process);

    }

    public function stopMonitorProcess(Process $process)
    {
        $response = $this->monitor->disablePusher($process);

        if ($response) {
            $process->monitoring = false;
            $process->save();
        }

        return $response;
    }

    public function deleteMonitorProcess(Process $process)
    {
        $response = $this->monitor->deletePusher($process);

        if ($response) {
            $process->id_pusher = null;
            $process->monitoring = false;
            $process->save();
        }

        return $response;
    }

    public function importProgressesFromDocument(Process $process)
    {
        $xml = $this->monitor->pusherDocument($process);

        $this->importXmlService->import(new ProgressBipBopXML($process, $xml));

        $this->createLogMonitor(oab: null, uf: null, process: $process);
    }

    public function searchCNJ(Process $process)
    {
        $xml = $this->monitor->searchCNJ($process);

        $this->importXmlService->import(new ProgressBipBopXML($process, $xml));

        $this->createLogMonitor(oab: null, uf: null, process: $process);
    }

    public function createPusherOabByStates(array $states)
    {
        $manager = app(ManagerTenant::class);

        $stateMonitors = UserStateMonitor::whereIn('id', $states)->get();

        foreach ($stateMonitors as $stateMonitor) {
            event(new CreateUserStateMonitor($stateMonitor,  $manager->getTokenJuzBrazil()));

            $this->createLogMonitor(
                oab: $stateMonitor->user->oab,
                uf: $stateMonitor->state->letter,
                process: null
            );
        }
    }

    public function createPusherOabUserState(UserStateMonitor $stateMonitor, string $tokenJusBrazil)
    {
        $response = $this->monitor->createPusherOab($stateMonitor->user->oab, $stateMonitor->state->letter, $tokenJusBrazil);

        if ($response) {
            $this->createLogMonitor(
                oab: $stateMonitor->user->oab,
                uf: $stateMonitor->state->letter,
                process: null
            );

            $this->setMonitoring($response, $stateMonitor);
        }
    }

    public function getProgresses()
    {
        return ProcessProgress::with(['process.person'])->notPublished()->notArchived()->get();
    }

    public function publishedProgress($id)
    {
        return ProcessProgress::whereIn('id', $id)->update(['published_at' => now()]);
    }


    public function archivedProgress($id)
    {
        return ProcessProgress::whereIn('id', $id)->update(['archived_at' => now()]);
    }


    public function getAllMonitorProcesses()
    {
        return MonitorProcess::notPublished()->notArchived()->get();
    }

    public function getMonitorProgressById($id)
    {
        return MonitorProcess::findOrFail($id);
    }


    public function archivedProcess($id)
    {
        return MonitorProcess::whereIn('id', $id)->update(['archived_at' => now()]);
    }

    public function publishedProcess($id)
    {
        return MonitorProcess::whereIn('id', $id)->update(['published_at' => now()]);
    }

    public function createLogMonitor(?string $oab, ?string $uf, ?Process $process) : Monitor
    {
        $monitor = [
            'oab' => $oab,
            'uf' => $uf,
            'process_id' => $process?->id
        ];

        return Monitor::create($monitor);
    }


    /**
     * @param Process $process
     * @return mixed
     */
    private function createOrEnabledPusher(Process $process)
    {
        if ($process->hasPusher()) {
            $response = $this->monitor->enablePusher($process);
            $process->monitoring = true;
            $process->save();

            return $response;
        }

        $response = $this->monitor->createPusher($process);

        if ($response) {
            $this->setMonitoringProcess($response, $process);
        }

        return $response;
    }

    /**
     * @param $response
     * @param UserStateMonitor $stateMonitor
     */
    private function setMonitoring($response, UserStateMonitor $stateMonitor): void
    {
        $stateMonitor->id_pusher = (string)$response->getHeaders()['X-BIPBOP-Document-ID']['0'];
        $stateMonitor->monitoring = true;
        $stateMonitor->save();
    }

    /**
     * @param $response
     * @param Process $process
     */
    private function setMonitoringProcess($response, Process $process): void
    {
        $process->id_pusher = (string)$response->getHeaders()['X-BIPBOP-Document-ID']['0'];
        $process->monitoring = true;
        $process->save();
    }


}
