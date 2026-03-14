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

        if (! $office->active) {
            Auth::guard('office-panel')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message = 'حسابك قيد المراجعة. سيتم تفعيله من الإدارة أولاً قبل تسجيل الدخول.';

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $message,
                ], 403);
            }

            return redirect()
                ->to($loginUrl)
                ->with('warning', $message);
        }

        return $next($request);
    }
}
