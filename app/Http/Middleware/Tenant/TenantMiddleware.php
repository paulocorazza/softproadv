<?php

namespace App\Http\Middleware\Tenant;

use App\Helpers\Helper;
use App\Models\Company;
use App\Tenant\ManagerTenant;
use Carbon\Carbon;
use Closure;

class TenantMiddleware
{
    private const DAYS_TESTING = 7;

    /**
     * @param Company $company
     * @return bool
     */
    private function testExpired(Company $company)
    {
        $daysAfterRegister = Carbon::now()->diffInDays($company->created_at);

        if ($daysAfterRegister >= self::DAYS_TESTING && $company->isTesting()) {
            return true;
        }

        return false;
    }


    /**
     * @param $company
     */
    private function setSessionCompany($company)
    {
        session()->put('company', $company);
    }


    /**
     * @param $manager
     * @param $company
     */
    private function setConnection($manager, $company): void
    {
        if (!Helper::in_route('plans') && (!Helper::in_route('paypal'))) {
            $manager->setConnection($company);
        }
    }


    public function handle($request, Closure $next)
    {
          $manager = app(ManagerTenant::class);

        if ($manager->domainIsMain()) {
            return $next($request);
        }

        //se for um subdominio
        $company = $manager->getCompany();


        if (!$company && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        }


        if ($request->url() != route('404.tenant')) {

            $this->setSessionCompany($company->only([
                'name',
                'uuid',
                'subdomain',
                'token_juzbrazil',
                'plan'
            ]));


            if ($this->testExpired($company) && (!Helper::in_route('plans')) &&
                (!Helper::in_route('paypal'))) {
                return redirect()->route('plans.choosePlan');
            }

            $this->setConnection($manager, $company);
        }


        return $next($request);
    }



}
