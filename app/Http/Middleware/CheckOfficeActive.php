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

        // Inactive accounts can browse all office panel pages in read-only mode,
        // but any write action is blocked centrally.
        if (! $office->active && ! in_array($request->method(), ['GET', 'HEAD', 'OPTIONS'], true)) {
            $message = 'حسابك غير مفعل حاليا. يمكنك التصفح فقط ولا يمكنك تنفيذ أي إجراء.';

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $message,
                ], 403);
            }

            $referer = $request->headers->get('referer');

            return redirect()
                ->to($referer ?: url($panelPath))
                ->with('warning', $message);
        }

        return $next($request);
    }
}
