<?php

namespace App\Http\Middleware;

use App\Services\PermissionService;
use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function __construct(protected PermissionService $perms) {}

    public function handle(Request $request, Closure $next, string ...$required)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message'=>'Unauthenticated'], 401);
        }

        // لو اتحطت الصلاحية على الراوت كـ action attribute
        $routePerm = $request->route()->action['permission'] ?? null;
        $need = $routePerm ? [$routePerm] : $required;

        // لازم يمتلك كل الـ permissions المطلوبة
        foreach ($need as $p) {
            if (!$this->perms->userHas($user, $p)) {
                return response()->json(['message'=>'Forbidden: missing permission '.$p], 403);
            }
        }

        return $next($request);
    }
}
