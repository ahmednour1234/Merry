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

        if (!auth()->guard('office-panel')->check()) {
            return redirect()->to($panel->getLoginUrl());
        }

        return $next($request);
    }
}
