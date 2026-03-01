<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Filament\Facades\Filament;

class CheckOfficeActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $office = Auth::guard('office-panel')->user();

        if (!$office) {
            return redirect()->to(Filament::getPanel('office')->getLoginUrl());
        }

        if ($office->blocked) {
            Auth::guard('office-panel')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->to(Filament::getPanel('office')->getLoginUrl())
                ->with('error', 'تم حظر حسابك. يرجى التواصل مع الإدارة.');
        }

        if (!$office->active) {
            return redirect()
                ->to(\App\Filament\Office\Pages\Dashboard::getUrl())
                ->with('warning', 'حسابك قيد المراجعة. سيتم إشعارك عند تفعيل الحساب.');
        }

        return $next($request);
    }
}
