<?php

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ManagerTenant
{
    public function domainIsMain()
    {
       //  dd(request()->getHost(), config('tenant.domain_main'));
        return in_array(request()->getHost(), config('tenant.domain_main'));
    }

    public function setConnection(Company $company)
    {
       try {
           DB::purge('tenant');

           $dbname = 'database.connections.tenant.';
           config()->set($dbname . 'host', $company->db_host);
           config()->set($dbname . 'database', $company->db_database);
           config()->set($dbname . 'username', $company->db_username);
           config()->set($dbname . 'password', $company->db_password);

           DB::reconnect('tenant');

           Schema::connection('tenant')->getConnection()->reconnect();
       } catch (\PDOException $exception) {
           throw new \Exception('Falha ao conectar ao banco de dados: ' . $exception->getMessage());
       }
    }

    public function setConnectionMain()
    {
        try {
            DB::purge('tenant');

            $dbname = 'database.connections.tenant.';
            config()->set($dbname . 'host', config('database.connections.mysql.host'));
            config()->set($dbname . 'database', config('database.connections.mysql.database'));
            config()->set($dbname . 'username', config( 'database.connections.mysql.username'));
            config()->set($dbname . 'password', config( 'database.connections.mysql.password'));

            DB::reconnect('tenant');

            Schema::connection('tenant')->getConnection()->reconnect();
        } catch (\PDOException $exception) {
            throw new \Exception('Falha ao conectar ao banco de dados: ' . $exception->getMessage());
        }
    }
}
