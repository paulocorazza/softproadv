<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use Closure;

class TenantFileSystems
{

    private function setConfig()
    {
        $uuid = session('company')['uuid'];

        config()->set([
            'filesystems.disks.tenant.root' => config('filesystems.disks.tenant.root') . "/{$uuid}",
            'filesystems.disks.tenant.url' => config('filesystems.disks.tenant.url') . "/{$uuid}"
        ]);
    }

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

        if (!$manager->domainIsMain()) {
            $this->setConfig();
        }

        return $next($request);
    }
}
