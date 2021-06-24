<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinancialsRequest;
use App\Services\bankIntegration\BankIntegrationService;
use Illuminate\Http\Request;

class BankIntegrationController extends Controller
{
    public function __construct(private BankIntegrationService $service)
    {
    }

    public function boletos(FinancialsRequest $request)
    {
        $this->service->generateBoletos($request);
    }
}
