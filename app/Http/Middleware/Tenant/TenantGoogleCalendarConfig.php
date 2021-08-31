<?php

namespace App\Http\Middleware\Tenant;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantGoogleCalendarConfig
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
       if ($request->user() && $request->user()->hasGoogleCalendar()) {
            $this->setConfig();
        }

        return $next($request);
    }

    private function setConfig()
    {
        $path =  config('filesystems.disks.tenant.root')  . '/' . Auth::user()->google_service_account_credentials;

        config()->set([
            'google-calendar.auth_profiles.service_account.credentials_json' => $path,
            'google-calendar.calendar_id' => Auth::user()->google_calendar_id
        ]);
    }
}
