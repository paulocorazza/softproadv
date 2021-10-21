<?php

namespace App\Repositories\Core\JuzBrazil;

use App\Jobs\createMonitorProcessOAB;
use App\Repositories\Contracts\XMLImportInterface;
use App\Repositories\Core\JuzBrazil\Record\ProcessOABRecord;


class OABBipBopXML implements XMLImportInterface
{

    public function __construct(
        private        $xml,
        private string $oab,
        private string $uf
    )
    {

    }

    public function importXML()
    {
        if ($this->hasProcesses()) {
            $this->processGenerate();
        }
    }

    private function processGenerate()
    {
        foreach ($this->xml->advogado->processos->processo as $processo) {
            $this->createProcess(new ProcessOABRecord(
                number_process: (string) $processo->numero_processo,
                tribunal: (string) $processo->tribunal_nome,
                oab: $this->oab,
                uf: $this->uf
            ));
        }
    }

    private function createProcess(ProcessOABRecord $processOABRecord)
    {
        $companyUuid = session()->has('company') ? session('company')['uuid'] : '';

        dispatch(new createMonitorProcessOAB($processOABRecord, $companyUuid));
    }

    /**
     * @return bool
     */
    private function hasProcesses(): bool
    {
        return isset($this->xml->advogado->processos);
    }
}
