<?php

namespace App\Http\Middleware;

use App\Services\PermissionService;
use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function __construct(protected PermissionService $perms)
    {
    }

    /**
     * Ensure the authenticated user has all required permissions.
     *
     * @param Request $request The incoming HTTP request
     * @param Closure $next    The next middleware closure
     * @param string  ...$required One or more required permissions from route middleware parameters
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string ...$required)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated'
                ], 401);
            }

            $token = $user->currentAccessToken();
            if ($token && ($token->can('*') || $token->can('system.manage'))) {
                return $next($request);
            }

            // لو اتحطت الصلاحية على الراوت كـ action attribute
            $routePerm = $request->route()->action['permission'] ?? null;
            $need = $routePerm ? [$routePerm] : $required;

            // لازم يمتلك كل الـ permissions المطلوبة
            foreach ($need as $p) {
                if (!$this->perms->userHas($user, $p)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Forbidden: missing permission ' . $p
                    ], 403);
                }
            }

            return $next($request);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('CheckPermission Middleware Error', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            $debug = app()->hasDebugModeEnabled();
            return response()->json([
                'success' => false,
                'message' => $debug ? $e->getMessage() : 'Permission check failed',
                'exception' => $debug ? get_class($e) : null,
                'file' => $debug ? $e->getFile() : null,
                'line' => $debug ? $e->getLine() : null,
            ], 500);
        }
    }
}
