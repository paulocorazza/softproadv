<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Services\MonitorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProcessMonitorController extends Controller
{
    public function __construct(private MonitorService $monitor)
    {
    }

    public function index(Request $request, $id)
    {
        Log::alert('Chegou na requisição', [
            'request' => $request
        ]);

        if ($request->getContent()) {
            $process = Process::findOrFail($id);

            $xml = $request->getContent();

            $this->monitor->pusher($process, $xml);
        }
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
}
