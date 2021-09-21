<?php

namespace App\Repositories\Core\JuzBrazil;

use App\Jobs\createProgress;
use App\Models\Process;
use App\Models\ProcessProgress;
use App\Repositories\Contracts\XMLIntegrationProcessInterface;
use Illuminate\Support\Facades\Log;


class ProcessBipBopXML implements XMLIntegrationProcessInterface
{

    public function __construct(
        private Process $process,
        private $xml
    )
    {
    }

    public function execute()
    {
        Log::debug('Iniciou a importação do XML');
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
                'process_id' => $this->process->id,
                'publication' => (string) $progress->descricao,
                'date' => $data,
                'data_hash' => $this->getDataHash($progress),
                'type' => $this->getType($progress),
                'description' => $this->getDescription($progress),
                'concluded' => false,
                'category'  => $this->getCategory($progress)
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

        return substr($arr_str[count($arr_str) -1],0, 191);
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

    private function getDataHash(mixed $progress)
    {
        if (isset($progress->data)) {
            return (string) $progress->data->attributes()['hash'];
        }
    }

    private function getCategory(mixed $progress)
    {
        return (string) $progress->attributes()['categoria'];
    }

    private function createProgress(array $progress)
    {
        dispatch(new createProgress($progress));
        Log::debug('Finalizou a importação do andamento');
    }


}
