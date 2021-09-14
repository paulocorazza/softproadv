<?php
namespace App\Repositories\Contracts;

use App\Models\Process;

interface MonitorInterface
{
    public function createPusher(Process $process);

    public function deletePusher(Process $process);

    public function searchOAB(string $oab);

    public function searchCNJ(Process $process);

}
