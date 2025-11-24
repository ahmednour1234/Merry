<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ResolveTenant
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost(); // ex: demo.mery.local أو custom.com

        // جرّب subdomain *.mery.local
        $slug = null;
        if (Str::endsWith($host, 'mery.local')) {
            $slug = Str::before($host, '.mery.local');
        }

        $tenant = DB::connection('system')->table('tenants as t')
            ->leftJoin('tenant_domains as d', 'd.tenant_id', '=', 't.id')
            ->when($slug && $slug !== 'admin', fn($q) => $q->where('t.slug', $slug))
            ->orWhere('d.domain', $host)
            ->select('t.*')
            ->first();

        if (!$tenant && !Str::startsWith($host, 'admin.')) {
            abort(404, 'Tenant not found');
        }

        if ($tenant) {
            app()->instance('tenant', (object) $tenant);
            app()->instance('tenant.id', $tenant->id);
            app()->instance('tenant.slug', $tenant->slug);

            // تحديد اللغة الافتراضية للتينانت
            $locale = $request->query('lang') ?: DB::connection('system')
                ->table('tenant_language')
                ->where('tenant_id', $tenant->id)
                ->where('is_default', 1)
                ->value('language_code');

            app()->setLocale($locale ?: 'en');
        }

        return $next($request);
    }
}
