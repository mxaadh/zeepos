<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SysClientLink;
use App\Support\TenantDatabase;

class UseTenantConnection
{
    public function handle($request, Closure $next)
    {
        if ($code = session('company_code')) {
            if ($client = SysClientLink::where('CompanyCode', $code)->first()) {
                TenantDatabase::connect($client, 'tenant');
            }
        }
        return $next($request);
    }
}
