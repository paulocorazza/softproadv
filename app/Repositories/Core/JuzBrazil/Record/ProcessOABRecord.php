<?php

namespace App\Repositories\Core\JuzBrazil\Record;

class ProcessOABRecord
{
    use ToArrayTrait;

    private string $number_process;
    private string $tribunal;
    private string $oab;
    private string $uf;

    public function __construct(string $number_process, string $tribunal, string $oab, string $uf)
    {

        $this->number_process = $number_process;
        $this->tribunal = $tribunal;
        $this->oab = $oab;
        $this->uf = $uf;
    }

    /**
     * @return string
     */
    public function getNumberProcess(): string
    {
        return $this->number_process;
    }

    /**
     * @return string
     */
    public function getTribunal(): string
    {
        return $this->tribunal;
    }

    /**
     * @return string
     */
    public function getOab(): string
    {
        return $this->oab;
    }

    /**
     * @return string
     */
    public function getUf(): string
    {
        return $this->uf;
    }
}
