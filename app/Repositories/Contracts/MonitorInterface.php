<?php
namespace App\Repositories\Contracts;

use App\Models\{Company, Process};


interface MonitorInterface
{
    public function createApiKey(Company $company);

    public function createPusher(Process $process);

    public function enablePusher(Process $process);

    public function disablePusher(Process $process);

    public function deletePusher(Process $process);

    public function pusherDocument(Process $process);

    public function createPusherOab(string $oab, string $uf, string $tokenJusBrazil);

    public function searchCNJ(Process $process);

}
