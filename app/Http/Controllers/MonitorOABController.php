<?php

namespace App\Http\Controllers;

use App\Repositories\Core\JuzBrazil\OABBipBopXML;
use App\Services\MonitorProgressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonitorOABController extends Controller
{
    public function __construct(private MonitorProgressService $monitor)
    {
    }

    public function index(Request $request, $oab, $uf)
    {
        Log::debug("Requisição OAB {$oab} / {$uf}");


        $xml = simplexml_load_string($request->getContent());

        Log::debug('getContent', [
            'getContent' => $xml->body
        ]);

        $this->monitor->importXML(new OABBipBopXML($xml->body, $oab, $uf));

        return response()->json('OK');
    }

    public function processes()
    {
        if (request()->ajax()) {
            return response()->json($this->monitor->getAllMonitorProcesses());
        }


        return view('tenants.monitor.processes');
    }

    public function show($id)
    {
        $monitorProcess = $this->monitor->getMonitorProgressById($id);

        return response()->json($monitorProcess);
    }

    public function archived(Request $request)
    {
        $id = $request->get('id');

        $response = $this->monitor->archivedProcess($id);

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()->back()
            ->with('success', 'Processo arquivado com sucesso!');
    }

    public function published(Request $request)
    {
        $id = $request->get('id');

        $response = $this->monitor->publishedProcess($id);

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()->back()
            ->with('success', 'Processo arquivado com sucesso!');
    }
}
