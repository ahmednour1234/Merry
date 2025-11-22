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
            Log::debug('CheckAbility: Starting', [
                'abilities' => $abilities,
                'has_bearer_token' => !empty($request->bearerToken()),
            ]);

            // Check if user is authenticated first
            $user = $request->user();
            if (!$user) {
                Log::warning('CheckAbility: User not authenticated');
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated. Please provide a valid token.',
                ], 401);
            }

            Log::debug('CheckAbility: User authenticated', ['user_id' => $user->id]);

            // Get the current access token
            try {
                $token = $user->currentAccessToken();
            } catch (\Throwable $tokenError) {
                Log::error('CheckAbility: Failed to get currentAccessToken', [
                    'user_id' => $user->id,
                    'error' => $tokenError->getMessage(),
                    'exception' => get_class($tokenError),
                    'file' => $tokenError->getFile(),
                    'line' => $tokenError->getLine(),
                ]);
                throw $tokenError;
            }
            
            if (!$token) {
                Log::warning('CheckAbility: No access token found', ['user_id' => $user->id]);
                return response()->json([
                    'success' => false,
                    'message' => 'No access token found.',
                ], 401);
            }

            Log::debug('CheckAbility: Token found', [
                'token_id' => $token->id,
                'token_abilities' => $token->abilities ?? [],
            ]);

            // Check if token has any of the required abilities
            $hasAbility = false;
            foreach ($abilities as $ability) {
                try {
                    if ($token->can($ability) || $token->can('*')) {
                        $hasAbility = true;
                        Log::debug('CheckAbility: Ability check passed', ['ability' => $ability]);
                        break;
                    }
                } catch (\Throwable $abilityError) {
                    Log::error('CheckAbility: Ability check failed', [
                        'ability' => $ability,
                        'error' => $abilityError->getMessage(),
                        'exception' => get_class($abilityError),
                    ]);
                    throw $abilityError;
                }
            }

            if (!$hasAbility) {
                Log::warning('CheckAbility: Token does not have required abilities', [
                    'required' => $abilities,
                    'token_abilities' => $token->abilities ?? [],
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden: Token does not have required ability. Required: ' . implode(', ', $abilities),
                    'required_abilities' => $abilities,
                    'token_abilities' => $token->abilities ?? [],
                ], 403);
            }

            Log::debug('CheckAbility: All checks passed, proceeding');
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

