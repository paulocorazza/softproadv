<?php

namespace App\Http\Controllers;

use App\Http\Requests\PusherOABRequest;
use App\Repositories\Core\JuzBrazil\OABBipBopXML;
use App\Services\ImportXmlService;
use App\Services\MonitorPusherService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonitorOABController extends Controller
{
    public function __construct(
        private MonitorPusherService $monitor,
        private ImportXmlService $importXmlService
    )
    {
    }

    public function index(Request $request, $oab, $uf)
    {
        $xml = simplexml_load_string($request->getContent());

        $this->importXmlService->import(new OABBipBopXML($xml->body, $oab, $uf));

        return response()->json('OK');
    }

    public function createPusherOabByStates(PusherOABRequest $request)
    {
        $states = $request->get('ids');

        $this->monitor->createPusherOabByStates($states);

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
