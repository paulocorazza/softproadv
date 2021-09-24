<?php

namespace App\Repositories\Core\JuzBrazil;

use App\Jobs\createMonitorProcessOAB;
use App\Repositories\Contracts\XMLIntegrationProcessInterface;

class OABBipBopXML implements XMLIntegrationProcessInterface
{

    public function __construct(
        private string $xml
    )
    {
    }

    public function execute()
    {
        $this->processGenerate();
    }

    private function processGenerate()
    {
        foreach ($this->xml->advogado->processos as $processo) {
            $newProcess = [
                'number_process' => (string) $processo->numero_processo,
                'tribunal'       => (string) $processo->tribunal_nome
            ];

            $this->createProcess($newProcess);
        }
    }

    private function createProcess(array $newProcess)
    {
        $companyUuid = session()->has('company') ? session('company')['uuid'] : '';

        dispatch(new createMonitorProcessOAB($newProcess, $companyUuid));
    }
}
