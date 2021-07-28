<?php

namespace App\Repositories\Core\Eloquent\Tenant;

use App\Events\Tenant\CompanyCreated;
use App\Events\Tenant\DatabaseCreated;
use App\Models\Company;
use App\Repositories\Contracts\CompanyRepositoryInterface;
use App\Repositories\Core\BaseEloquentRepository;
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Endpoints\DNS;
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
        $key = new \Cloudflare\API\Auth\APIToken(config('cloudflare.token'));
        $adapter = new \Cloudflare\API\Adapter\Guzzle($key);

        $zone = new \Cloudflare\API\Endpoints\Zones($adapter);
        $zoneID = $zone->getZoneID(config('cloudflare.email'));

        $dns = new \Cloudflare\API\Endpoints\DNS($adapter);
        if ($dns->addRecord($zoneID, "A", $company->subdomain, config('cloudflare.server'), 0, true) === true) {
           return true;
        }
    }
}
