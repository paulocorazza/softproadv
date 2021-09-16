<?php

namespace App\Services;

use App\Models\Process;
use App\Repositories\Contracts\MonitorInterface;
use App\Repositories\Core\JuzBrazil\ProcessBipBopXML;

class MonitorService
{
    public function __construct(private MonitorInterface $monitor)
    {

    }


    public function pusher(Process $process, $xml)
    {
        $this->processXML($process, $xml);
    }

    public function start(Process $process)
    {
        return $this->createOrEnable($process);

    }

    public function stop(Process $process)
    {
        $response = $this->monitor->disablePusher($process);

        if ($response) {
            $process->monitoring = false;
            $process->save();
        }

        return $response;
    }

    public function delete(Process $process)
    {
        $response = $this->monitor->deletePusher($process);

        if ($response) {
            $process->id_pusher = null;
            $process->monitoring = false;
            $process->save();
        }

        return $response;
    }

    public function document(Process $process)
    {
        return $this->monitor->pusherDocument($process);

        $this->processXML($process, $xml);
    }

    public function searchCNJ(Process $process)
    {
        $xml = $this->monitor->searchCNJ($process);

        $this->processXML($process, $xml);
    }

    private function processXML(Process $process, $xml)
    {
        $processXML = new ProcessXMLMonitor();
        $processXML->execute(new ProcessBipBopXML($process, $xml));
    }

    /**
     * @param Process $process
     * @return mixed
     */
    private function createOrEnable(Process $process)
    {
        if (!empty($process->id_pusher)) {
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