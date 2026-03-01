<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Filament\Facades\Filament;

class CheckOfficeSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $panel = Filament::getPanel('office');
        $path = $request->path();
        
        if (str_starts_with($path, $panel->getPath() . '/login') ||
            str_starts_with($path, $panel->getPath() . '/register') ||
            str_starts_with($path, $panel->getPath() . '/password') ||
            str_starts_with($path, $panel->getPath() . '/subscriptions')) {
            return $next($request);
        }

        $office = Auth::guard('office-panel')->user();

        if ($office) {
            $hasActiveSubscription = \App\Models\OfficeSubscription::on('system')
                ->where('office_id', $office->id)
                ->where('active', true)
                ->where('ends_at', '>=', now())
                ->exists();
            
            if (!$hasActiveSubscription) {
                $panel = Filament::getPanel('office');
                return redirect()->to($panel->getUrl() . '/subscriptions');
            }
        }

        return $next($request);
    }
}
