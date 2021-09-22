<?php

namespace App\Jobs;

use App\Events\CreateProgressIntegration;
use App\Models\ProcessProgress;
use GuzzleHttp\Client;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class createProgress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private array $progress,
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
        if (!ProcessProgress::where('data_hash', $this->progress['data_hash'])->first()) {
            $progress = ProcessProgress::create($this->progress);

            $this->progress = $progress->load('process.person');

            broadcast(new CreateProgressIntegration($progress, $this->uuidCompany));
        }
    }

}
