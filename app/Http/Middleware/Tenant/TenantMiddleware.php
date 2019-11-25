<?php

namespace App\Http\Middleware\Tenant;

use App\Models\Company;
use App\Tenant\ManagerTenant;
use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * Registrar o middleware em Kernel.php
     */
    private function getCompany($subdomain)
    {
        return Company::where('subdomain', '=', $subdomain)->first();
    }


   private function subDomain()
   {
       $piecesHost = explode('.',  request()->getHost());
       $tenant = $piecesHost[0];
       return $tenant;
   }



    public function handle($request, Closure $next)
    {
        $manager = app(ManagerTenant::class);

        if ($manager->domainIsMain()) {
            return $next($request);
        }

        $company = $this->getCompany($this->subDomain());

        if (!$company && $request->url() != route('404.tenant')) {
            return redirect()->route('404.tenant');
        }

        if ($request->url() != route('404.tenant')) {
            $manager->setConnection($company);
        }


        return $next($request);
    }

}
