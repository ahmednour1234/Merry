<?php

namespace App\Http\Middleware\Filament;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfficeAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $panel = Filament::getPanel('office');
        $path = $request->path();
        
        if (str_starts_with($path, $panel->getPath() . '/login') ||
            str_starts_with($path, $panel->getPath() . '/register') ||
            str_starts_with($path, $panel->getPath() . '/password')) {
            return $next($request);
        }
        
        if (!auth()->guard('office-panel')->check()) {
            $loginUrl = url($panel->getPath() . '/login');
            return redirect()->to($loginUrl);
        }

        return $next($request);
    }
}
