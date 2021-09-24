<?php

namespace App\Http\Controllers;

use App\Repositories\Core\JuzBrazil\OABBipBopXML;
use App\Services\MonitorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonitorOABController extends Controller
{
    public function __construct(private MonitorService $monitor)
    {
    }

    public function index(Request $request, $oab, $uf)
    {
        Log::debug('Requisição OAB - ' . $oab . - ' UF:' . $uf);

        $xml = simplexml_load_string($request->getContent());

        $this->monitor->importXML(new OABBipBopXML($xml->body));

        return response()->json('OK');
    }
}
