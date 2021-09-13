<?php


namespace App\Services\bankIntegration\Itau;


use App\Models\Financial;
use App\Models\FinancialAccount;
use App\Services\Contracts\Boleto;

class ItauBoleto implements Boleto
{
    public function __construct(private ?Boleto $next)
    {

    }


    public function generate(Financial $financial)
    {
        if ($financial->financialAccount->isItau()) {
            return 'Banco Itau';
        }

        if (!is_null($this->next)) {
            return $this->next->generate($financial);
        }

        throw new Exception("Banco informado não foi implementado");
    }
}
