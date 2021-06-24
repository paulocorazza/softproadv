<?php


namespace App\Services\bankIntegration;


use App\Http\Requests\FinancialsRequest;
use App\Models\Financial;

class BankIntegrationService
{
    public function __construct(private Financial $financial)
    {
    }

    public function generateBoletos(FinancialsRequest $request)
    {
        $finalcials = array_values($request->financials);

        dd($finalcials);

    }
}
