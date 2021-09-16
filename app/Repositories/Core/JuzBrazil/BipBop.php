<?php

namespace App\Repositories\Core\JuzBrazil;

use App\Jobs\createProgress;
use App\Models\Process;
use App\Repositories\Contracts\MonitorInterface;
use App\Tenant\ManagerTenant;
use GuzzleHttp\Client;


class BipBop implements MonitorInterface
{
    private string $token;

    private string $company;

    public function __construct()
    {
        $this->token = config('jusbrazil.token');
        $this->company = session()->has('company') ? session('company')['uuid'] : 'master';
    }

    public function createPusher(Process $process)
    {
        $q = "INSERT INTO 'PUSHJURISTEK'.'JOB'";

        $pushQuery = "SELECT FROM 'JURISTEK'.'INFO'";

        $data = "SELECT FROM 'CNJ'.'PROCESSO' WHERE 'PROCESSO'='{$process->number_process}'";

        $pushLabel = $this->pusherLabel($process);

        $urlBack = 'http://52de-186-237-1-133.ngrok.io';  //$this->urlBack($process);

        $url = "https://irql.bipbop.com.br/?q={$q}&pushQuery={$pushQuery}&data={$data}&apiKey={$this->token}&pushLabel={$pushLabel}&pushMaxVersion=0&Juristekcallback={$urlBack}";

        $client = new Client();

        return $client->get($url);
    }


    public function enablePusher(Process $process)
    {
        $q = "UPDATE 'PUSHJURISTEK'.'JOB'";

        $url = "https://irql.bipbop.com.br/?q={$q}&apiKey={$this->token}&id={$process->id_pusher}&pushMaxVersion=0";

        $client = new Client();

        return $client->post($url);
    }

    public function disablePusher(Process $process)
    {
        $q = "UPDATE 'PUSHJURISTEK'.'JOB'";

        $url = "https://irql.bipbop.com.br/?q={$q}&apiKey={$this->token}&id={$process->id_pusher}&pushMaxVersion=-1";

        $client = new Client();

        return $client->post($url);
    }


    public function deletePusher(Process $process)
    {
        $q = "DELETE FROM 'PUSH'.'JOB'";

        $url = "https://irql.bipbop.com.br/?q={$q}&id={$process->id_pusher}&apiKey={$this->token}";

        $client = new Client();

        return $client->get($url);
    }

    public function pusherDocument(Process $process)
    {
        $q = "SELECT FROM 'PUSH'.'DOCUMENT'";

        $url = "https://irql.bipbop.com.br/?q={$q}&apiKey={$this->token}&id={$process->id_pusher}&pushMaxVersion=pushMaxVersion";

        $client = new Client();

        $request = $client->post($url);

        $response = $request->getBody()->getContents();

        $xml = simplexml_load_string($response);

        return $xml;
    }

    public function searchOAB(string $oab)
    {
        // TODO: Implement searchOAB() method.
    }

    public function searchCNJ(Process $process)
    {
        $q = "SELECT FROM 'JURISTEK'.'INFO'";
        $query = "SELECT FROM 'CNJ'.'PROCESSO' WHERE 'PROCESSO'='{$process->number_process}'";

        $url = "https://irql.bipbop.com.br/?data={$query}&q={$q}&apiKey={$this->token}";

        $client = new Client();
        $request = $client->get($url);

        $response = $request->getBody()->getContents();

        $xml = simplexml_load_string($response);

        return $xml->body;
    }

    private function pusherLabel(Process $process)
    {
        return $this->company . '-' . $process->number_process;
    }

    private function urlBack(Process $process)
    {
        $manager = app(ManagerTenant::class);

        if (!$manager->domainIsMain()) {
            return 'https://' .  $manager->subDomain() .  config('app.url_client') . "/processes/{$process->id}/monitor";
        }

        return  config('app.url') . "/processes/{$process->id}/monitor";

    }
}
