<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Auth\APIToken;
use Cloudflare\API\Endpoints\DNS;
use Cloudflare\API\Endpoints\Zones;
use Illuminate\Support\Facades\DB;

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class EloquentCompanyRepository extends BaseEloquentRepository
    implements CompanyRepositoryInterface

{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /**
     * @return string
     */
    public function model()
    {
        return Company::class;
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {

            $company = parent::create($data);

            $this->createDNSCloudFlare($company);

            $createDataBase = ($data['create_database']) ? true : false;

            $this->databaseGenerator($company, $createDataBase);

            DB::commit();

            return $company;
        } catch (\Exception $e) {

            dd($e);
            DB::rollBack();

            redirect()->back()
                ->withErrors('Erro ao criar a empresa: ' . $e->getMessage());
        }
    }


    /**
     * @param Company $company
     * @param bool $createDataBase
     * @return array|null
     */

    public function databaseGenerator(Company $company, bool $createDataBase)
    {
        //Caso o banco esteja em outro servidor, precisa chamar o método que alterna a conexão

        if ($createDataBase) {
            return event(new CompanyCreated($company));
        }

        return event(new DatabaseCreated($company));
    }

    public function subDomainExists($subDomain)
    {
        $domain = $this->whereFirst('subdomain', '=', $subDomain);

        return ($domain) ? 'true' : 'false';
    }

    private function createDNSCloudFlare(mixed $company)
    {
        /*        $key = new APIKey(config('cloudflare.email'),  config('cloudflare.token'));

                $adapter = new Guzzle($key);

                $zoneID = config('cloudflare.zone');

                $dns = new DNS($adapter);
                if ($dns->addRecord($zoneID, "A", $company->subdomain, config('cloudflare.server'), 0, true) === true) {
                   return true;
                }*/

        /* Cloudflare.com | APİv4 | Api Ayarları */
        $apikey		= config('cloudflare.token'); // Cloudflare Global API
        $email 		= config('cloudflare.email'); // Cloudflare Email Adress
        $domain 	= 'softproadv-homolog.com.br';  // zone_name // Cloudflare Domain Name
        $zoneid 	= config('cloudflare.zone'); // zone_id // Cloudflare Domain Zone ID

// A-record oluşturur DNS sistemi için.
        $ch = curl_init("https://api.cloudflare.com/client/v4/zones/".$zoneid."/dns_records");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Email: '.$email.'',
            'X-Auth-Key: '.$apikey.'',
            'Cache-Control: no-cache',
// 'Content-Type: multipart/form-data; charset=utf-8',
            'Content-Type:application/json',
            'purge_everything: true'

        ));


        $data = array(

            'type' => 'A',
            'name' => $company->subdomain,
            'content' =>  config('cloudflare.server'),
            'zone_name' => ''.$domain.'',
            'zone_id' => ''.$zoneid.'',
            'proxied' => true,
            'ttl' => '120'
        );

        $data_string = json_encode($data);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);


        $sonuc = curl_exec($ch);

        /*
            //print_r($sonuc);
        */

        curl_close($ch);
    }
}
