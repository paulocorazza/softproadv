<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\ProcessProgress;
use App\Repositories\Core\JuzBrazil\ProgressBipBopXML;
use App\Services\MonitorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MonitorProgressController extends Controller
{
    public function __construct(private MonitorService $monitor)
    {
        $this->middleware('can:monitor_start')->only(['start']);
        $this->middleware('can:monitor_stop')->only(['stop']);
        $this->middleware('can:monitor_delete')->only(['delete']);
    }

    public function index(Request $request, $id)
    {
        Log::debug('Requisição do processo - ' . $id);

        if (!$process = Process::findOrFail($id)) {
            return response()->json('Processo não encontrado');
        }

        $xml = simplexml_load_string($request->getContent());

        $this->monitor->importXML(new ProgressBipBopXML($process, $xml->body));


        return response()->json('OK');
    }

    public function progresses()
    {
        if (request()->ajax()) {
            return response()->json($this->monitor->getProgresses());
        }


        return view('tenants.monitor.progress-vue');
    }

    public function start(Process $process)
    {
        $monitor = $this->monitor->start($process);

        if ($monitor) {
            return redirect()->back()
                ->with('success', 'Monitoramento iniciado com sucesso!');
        }
    }

    public function stop(Process $process)
    {
        $monitor = $this->monitor->stop($process);

        if ($monitor) {
            return redirect()->back()
                ->with('success', 'Monitoramento suspenso com sucesso!');
        }
    }


    public function delete(Process $process)
    {
        $monitor = $this->monitor->delete($process);

        if ($monitor) {
            return redirect()->back()
                ->with('success', 'Monitoramento deletado com sucesso!');
        }
    }

    public function document(Process $process)
    {
        $this->monitor->document($process);

        return redirect()->route('home');
    }

    public function searchCNJ(Process $process)
    {
        $this->monitor->searchCNJ($process);

        return redirect()->route('home');
    }

    public function published(Request $request)
    {
        $id = $request->get('id');

        $response = $this->monitor->published($id);

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()->back()
            ->with('success', 'Andamento publicado com sucesso!');
    }

    public function archived(Request $request)
    {
        $id = $request->get('id');

        $response = $this->monitor->archived($id);

        if ($request->ajax()) {
            return response()->json($response);
        }

        return redirect()->back()
            ->with('success', 'Andamento arquivado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $progress = ProcessProgress::findOrFail($id);

        $data = $request->all();
        $data['concluded'] = (!empty($data['concluded'])) ? true : false;

        $progress->update($data);


        return '1';
    }
}
