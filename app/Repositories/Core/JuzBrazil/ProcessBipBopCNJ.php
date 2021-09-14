<?php

namespace App\Repositories\Core\JuzBrazil;

use App\Helpers\Helper;
use App\Jobs\createProgress;
use App\Models\Process;
use App\Repositories\Contracts\XMLIntegrationProcessInterface;
use Carbon\Carbon;

class ProcessBipBopCNJ implements XMLIntegrationProcessInterface
{

    public function __construct(
        private Process $process,
        private $xml
    )
    {
    }

    public function execute()
    {
        $this->processesIterate();
    }


    public function processesIterate() : void
    {
        foreach ($this->xml->processo as $processo) {
            $this->progressGenerate($processo);
        }
    }


    /**
     * @param mixed $processo
     * @return void
     */
    private function progressGenerate(mixed $processo) : void
    {
        foreach ($processo->andamentos->andamento as $progress) {

            $data = (string) $progress->data;

            $progress = [
                'publication' => (string) $progress->descricao,
                'date' => $data,
                'date_term' => $data,
                'type' => $this->getType($progress),
                'description' => $this->getDescription($progress),
                'concluded' => false
            ];

            $this->createProgress($progress);
        }
    }


    /**
     * @param mixed $progress
     * @return string
     */
    private function getDescription(mixed $progress): string
    {
        $description = (string) $progress->descricao;

        $arr_str = explode('<br />',  nl2br($description));

        return $arr_str[count($arr_str) -1];
    }

     /**
     * @param mixed $progress
     * @return string
     */
    private function getType(mixed $progress): string
    {
        if (isset($progress->tipo_andamento)) {
            return (string) $progress->tipo_andamento;
        }

        if (isset($progress->tipo_incidente)) {
            return (string) $progress->tipo_incidente;
        }
    }

    private function createProgress(array $progress)
    {
        dispatch(new createProgress($this->process, $progress));
    }

}
