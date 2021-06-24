<?php


namespace App\Services\bankIntegration;


use App\Services\bankIntegration\Itau\ItauBoleto;

class GenerateBoleto
{
    public function __construct(private mixed $financials)
    {
    }

    public function generate()
    {
        foreach ($this->financials as $financial) {
            $boleto = new ItauBoleto();

            return $boleto->generate($financial);
        }
    }
}
