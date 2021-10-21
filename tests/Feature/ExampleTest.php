<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Process;
use App\Repositories\Core\JuzBrazil\BipBop;
use App\Services\MonitorPusherService;
use App\Tenant\ManagerTenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $company = Company::find(5);

        $manager = new ManagerTenant();
        $manager->setConnection($company);

        $process = Process::findOrFail(90);

        $manager->setConnectionMain();

        $monitor = new MonitorPusherService(new BipBop());

        $xml = $monitor->importProgressesFromDocument($process);


        $response = Http::withHeaders(["Content-Type" => "text/xml;charset=utf-8"])
            ->post("http://tarossi.softproadv/processes/90/monitor", ['body' => $xml]);

        dd($response);


    }
}
