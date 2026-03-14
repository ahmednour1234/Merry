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
        $panel = Filament::getPanel('office');
        $path = trim($request->path(), '/');
        $panelPath = trim($panel->getPath(), '/');

        if (str_starts_with($path, $panelPath . '/login') ||
            str_starts_with($path, $panelPath . '/register') ||
            str_starts_with($path, $panelPath . '/password')) {
            return $next($request);
        }

        $office = Auth::guard('office-panel')->user();

        $loginUrl = url(trim($panel->getPath(), '/') . '/login');

        if (!$office) {
            return redirect()->to($loginUrl);
        }

        if ($office->blocked) {
            Auth::guard('office-panel')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->to($loginUrl)
                ->with('error', 'تم حظر حسابك. يرجى التواصل مع الإدارة.');
        }

        $inactiveAllowedPaths = [
            $panelPath . '/subscriptions',
            $panelPath . '/profile',
        ];

        $isAllowedForInactive = collect($inactiveAllowedPaths)
            ->contains(fn (string $allowedPath): bool => str_starts_with($path, $allowedPath));

        if (!$office->active && ! $isAllowedForInactive) {
            return redirect()
                ->to(url($panelPath . '/subscriptions'))
                ->with('warning', 'حسابك قيد المراجعة. سيتم إشعارك عند تفعيل الحساب.');
        }

        return $next($request);
    }
}
