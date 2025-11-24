<?php

namespace App\Http\Middleware;

use App\Models\SystemPersonalAccessToken;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard  (اختياري لو حابب تستخدمه لاحقًا)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $guard = null)
    {
        $tokenPlain = $request->bearerToken();

        if (! $tokenPlain) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated: Bearer token is missing.',
            ], 401);
        }

        // نحاول نجيب التوكن من موديلك المخصص (system + identity)
        $accessToken = SystemPersonalAccessToken::findToken($tokenPlain);

        if (! $accessToken) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated: Invalid or expired token.',
            ], 401);
        }

        $user = $accessToken->tokenable;

        if (! $user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated: Token user not found.',
            ], 401);
        }

        // نخلي اليوزر مرتبط بالتوكن (Sanctum style)
        if (method_exists($user, 'withAccessToken')) {
            $user->withAccessToken($accessToken);
        }

        // نثبّت اليوزر في Auth وفي request
        Auth::setUser($user);
        $request->setUserResolver(fn () => $user);

        return $next($request);
    }
}
