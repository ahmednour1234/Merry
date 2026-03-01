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
        if (!auth()->guard('office-panel')->check()) {
            // Construct the login URL manually to avoid route name issues
            $panel = Filament::getPanel('office');
            $loginUrl = url($panel->getPath() . '/login');
            return redirect()->to($loginUrl);
        }

        return $next($request);
    }
}
