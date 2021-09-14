<?php

namespace App\Services;

use App\Models\Process;
use App\Repositories\Contracts\MonitorInterface;
use App\Repositories\Core\JuzBrazil\ProcessBipBopCNJ;

class MonitorService
{
    public function __construct(private MonitorInterface $monitor)
    {

    }

    public function start(Process $process)
    {
        $response = $this->monitor->createPusher($process);

        if ($response) {
            $process->monitoring = true;
            $process->save();
        }

        return $response;

    }

    public function stop(Process $process)
    {
        $response = $this->monitor->deletePusher($process);

        if ($response) {
            $process->monitoring = false;
            $process->save();
        }

        return $response;
    }

    public function searchCNJ(Process $process)
    {
        $xml = $this->monitor->searchCNJ($process);

        $this->processXML($process, $xml);
    }

    private function processXML(Process $process, $xml)
    {
        $processXML = new ProcessXMLMonitor();
        $processXML->execute(new ProcessBipBopCNJ($process, $xml));
    }
}
