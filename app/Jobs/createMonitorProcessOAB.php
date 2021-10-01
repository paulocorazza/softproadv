<?php

namespace App\Jobs;

use App\Events\CreateProcessIntegration;
use App\Models\MonitorProcess;
use App\Models\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class createMonitorProcessOAB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $process,
        private string $uuidCompany)
    {
        //
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $numberProcess =  $this->process['number_process'];

        $process = Process::where('number_process', $numberProcess)->first();
        $monitorOAB = MonitorProcess::where('number_process', $numberProcess)->first();

        Log::debug('handle jog', [
            'process' => $process,
            'monitorOAB' => $monitorOAB
        ]);

        if (!$process && !$monitorOAB) {
            Log::debug('criou processo');
           $newMonitorOAB = MonitorProcess::create($this->process);
            Log::debug('criou processo');

            broadcast(new CreateProcessIntegration($newMonitorOAB, $this->uuidCompany));
        }

        Log::debug('não criou processo');
    }
}
