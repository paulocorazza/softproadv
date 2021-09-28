<?php

namespace App\Services;

use App\Models\MonitorProcess;
use App\Models\Process;
use App\Models\ProcessProgress;
use App\Models\UserStateMonitor;
use App\Repositories\Contracts\MonitorInterface;
use App\Repositories\Contracts\XMLIntegrationProcessInterface;
use App\Repositories\Core\JuzBrazil\ProgressBipBopXML;

class MonitorProgressService
{

    public function __construct(private MonitorInterface $monitor)
    {

    }


    public function importXML(XMLIntegrationProcessInterface $integration)
    {
        $this->processXML($integration);
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
        $this->processXML(new ProgressBipBopXML($process, $xml));
    }

    public function searchCNJ(Process $process)
    {
        $xml = $this->monitor->searchCNJ($process);

        $this->processXML(new ProgressBipBopXML($process, $xml));
    }

    public function createPusherUserState(UserStateMonitor $stateMonitor, ?array $company)
    {
        $response = $this->monitor->createPusherOab($stateMonitor->user->oab, $stateMonitor->state->letter, $company);

        if ($response) {
            $stateMonitor->id_pusher = (string)$response->getHeaders()['X-BIPBOP-Document-ID']['0'];
            $stateMonitor->monitoring = true;
            $stateMonitor->save();
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

    private function processXML(XMLIntegrationProcessInterface $integration)
    {
        $processXML = new ProcessXMLMonitor();
        $processXML->importXML($integration);
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
            $process->id_pusher = (string) $response->getHeaders()['X-BIPBOP-Document-ID']['0'];
            $process->monitoring = true;
            $process->save();
        }

        return $response;
    }
}
