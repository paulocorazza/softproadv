<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;

class NotDomainMain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $manager = app(ManagerTenant::class);

        if ($manager->domainIsMain()) {
            abort(401, 'Acesso negado!');
        }

        return $next($request);
    }
}
