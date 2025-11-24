<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponse
{
    public function handle(Request $request, Closure $next)
    {
        // إجبار كل ريكوست API يكون JSON
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
