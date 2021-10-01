<?php

namespace App\Repositories\Core\JuzBrazil;

use App\Jobs\createMonitorProcessOAB;
use App\Repositories\Contracts\XMLIntegrationProcessInterface;
use Illuminate\Support\Facades\Log;

class OABBipBopXML implements XMLIntegrationProcessInterface
{

    public function __construct(
        private string $xml,
        private string $oab,
        private string $uf
    )
    {
    }

    public function importXML()
    {
   //    if ($this->hasProcesses()) {
            $this->processGenerate();
    //   }
    }

    private function processGenerate()
    {
        foreach ($this->xml->advogado->processos as $processo) {
            $newProcess = [
                'number_process' => (string) $processo->numero_processo,
                'tribunal'       => (string) $processo->tribunal_nome,
                'oab'            => $this->oab,
                'uf'             => $this->uf
            ];

            $this->createProcess($newProcess);
        }
    }

    private function createProcess(array $newProcess)
    {
        $companyUuid = session()->has('company') ? session('company')['uuid'] : '';
        Log::debug('tem processos');
        dispatch(new createMonitorProcessOAB($newProcess, $companyUuid));
    }

    /**
     * @return bool
     */
    private function hasProcesses(): bool
    {
        return isset($this->xml->advogado->processos);
    }
}
