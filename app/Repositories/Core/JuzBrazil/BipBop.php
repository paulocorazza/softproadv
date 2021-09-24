<?php

namespace App\Repositories\Core\JuzBrazil;

use App\Jobs\createProgress;
use App\Models\Company;
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
        if (session()->has('company')) {
            $this->company = session('company')['uuid'];
            $this->token = session('company')['token_juzbrazil'];
        } else {
            $this->company = 'master';
            $this->token = config('jusbrazil.token');
        }
    }


    public function createApiKey(Company $company)
    {
        $token = config('jusbrazil.token');

        $q = "SELECT FROM 'BIPBOPAPIKEY'.'GENERATE' WHERE 'ALIAS' = '{$company->subdomain}'";

        $url = "https://irql.bipbop.com.br/?q={$q}&apiKey={$token}&username={$company->subdomain}";

        $client = new Client();

        $request = $client->post($url);

        $response = $request->getBody()->getContents();

        $xml = simplexml_load_string($response);

        return (string) $xml->body->company->apiKey;
    }

    public function createPusher(Process $process)
    {
        $q = "INSERT INTO 'PUSHJURISTEK'.'JOB'";

        $pushQuery = "SELECT FROM 'JURISTEK'.'INFO'";

        $data = "SELECT FROM 'CNJ'.'PROCESSO' WHERE 'PROCESSO'='{$process->number_process}'";

        $pushLabel = $this->pusherLabel($process);

        $urlBack =  $this->urlCallBackProcess($process);

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

        return $xml->body;
    }

    public function createPusherOab(string $oab, string $uf)
    {
        $q = "SELECT FROM 'OABPROCESSO'.'PROCESSOS'";

        $callback = $this->urlCallBackOab($oab, $uf);

        $url = "https://irql.bipbop.com.br/?q={$q}&numero_oab={$oab}&uf={$uf}&apiKey={$this->token}&pushcallback={$callback}";

        $client = new Client();

        return $client->get($url);
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

    private function urlCallBackProcess(Process $process)
    {
        $manager = app(ManagerTenant::class);

        if (!$manager->domainIsMain()) {
            return 'http://' .  $manager->subDomain() .  config('app.url_client') . "/api/processes/{$process->id}/monitor";
        }

        return  config('app.url') . "/api/processes/{$process->id}/monitor";
    }

    private function urlCallBackOab(string $oab, string $uf)
    {
        $manager = app(ManagerTenant::class);

        if (!$manager->domainIsMain()) {
            return 'http://' .  $manager->subDomain() .  config('app.url_client') . "/api/processes/oab/{$oab}/uf/{$uf}/monitor";
        }

        return  config('app.url') . "/api/process/oab/{$oab}/uf/{$uf}/monitor";
    }



}
