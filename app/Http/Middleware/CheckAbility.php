<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckAbility
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$abilities
     * @return mixed
     */
    public function handle($request, Closure $next, ...$abilities)
    {
        try {
            // Check if user is authenticated first
            if (!$request->user()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated. Please provide a valid token.',
                ], 401);
            }

            // Get the current access token
            $token = $request->user()->currentAccessToken();
            
            if (!$token) {
                return response()->json([
                    'success' => false,
                    'message' => 'No access token found.',
                ], 401);
            }

            // Check if token has any of the required abilities
            $hasAbility = false;
            foreach ($abilities as $ability) {
                if ($token->can($ability) || $token->can('*')) {
                    $hasAbility = true;
                    break;
                }
            }

            if (!$hasAbility) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden: Token does not have required ability. Required: ' . implode(', ', $abilities),
                    'required_abilities' => $abilities,
                    'token_abilities' => $token->abilities ?? [],
                ], 403);
            }

            // All checks passed, proceed to next middleware
            return $next($request);
            
        } catch (\Throwable $e) {
            // Log the error with full details
            Log::error('CheckAbility Middleware Error', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
                'abilities' => $abilities ?? [],
                'user_id' => $request->user()?->id,
            ]);

            // Return detailed error in debug mode
            $debug = app()->hasDebugModeEnabled();
            
            return response()->json([
                'success' => false,
                'message' => $debug ? $e->getMessage() : 'Authentication error occurred',
                'exception' => $debug ? get_class($e) : null,
                'file' => $debug ? $e->getFile() : null,
                'line' => $debug ? $e->getLine() : null,
            ], 500);
        }
    }
}

