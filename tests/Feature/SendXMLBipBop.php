<?php

namespace Tests\Feature;

use App\Models\Process;
use App\Services\MonitorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SendXMLBipBop extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function sendXML()
    {
        $process = Process::find(90);

        $monitor = new MonitorService();

        $xml = $monitor->document($process);

        $response = $this->post("http://tarossi.softproadv/processes/{$process->id}/monitor", [
            'body' => $xml,
        ]);


    }
}
