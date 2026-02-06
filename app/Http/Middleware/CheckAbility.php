<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckAbility
{
    /**
     * Handle an incoming request.
     *
     * usage: ->middleware('ability:system.manage,users.view')
     */
    public function handle(Request $request, Closure $next, ...$abilities): Response
    {
        Log::debug('CheckAbility: start', [
            'abilities'        => $abilities,
            'has_bearer_token' => !empty($request->bearerToken()),
        ]);

        // 1) جِب اليوزر من sanctum guard
        $user = $request->user('sanctum');

        if (! $user) {
            Log::warning('CheckAbility: no user (unauthenticated)');
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated. Please provide a valid token.',
            ], 401);
        }

        // 2) جِب التوكن الحالي
        $token = $user->currentAccessToken();

        if (! $token) {
            Log::warning('CheckAbility: user has no current token', [
                'user_id' => $user->id,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'No access token found for this user.',
            ], 401);
        }

        $tokenAbilities = $token->abilities ?? [];

        Log::debug('CheckAbility: token info', [
            'user_id'         => $user->id,
            'token_id'        => $token->id,
            'token_abilities' => $tokenAbilities,
        ]);

        // 3) لو معاه * يبقى سوبر
        if (in_array('*', $tokenAbilities, true)) {
            return $next($request);
        }

        // 4) لو مفيش abilities في الراوت أصلاً → نعدّي
        if (empty($abilities)) {
            return $next($request);
        }

        // 5) استخدم tokenCan الرسمي من Sanctum
        foreach ($abilities as $ability) {
            if ($user->tokenCan($ability)) {
                Log::debug('CheckAbility: passed', ['ability' => $ability]);
                return $next($request);
            }
        }

        Log::warning('CheckAbility: missing required abilities', [
            'required_abilities' => $abilities,
            'token_abilities'    => $tokenAbilities,
        ]);

        return response()->json([
            'success'            => false,
            'message'            => 'Forbidden: Missing required ability.',
            'required_abilities' => $abilities,
            'token_abilities'    => $tokenAbilities,
        ], 403);
    }
}
