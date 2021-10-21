<?php

namespace App\Jobs;

use App\Models\Company;
use App\Repositories\Contracts\MonitorInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateApiKeyJuzBrazil implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Company $company)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MonitorInterface $monitor)
    {
        $this->company->token_juzbrazil = $monitor->createApiKey($this->company);
        $this->company->save();
    }
}
