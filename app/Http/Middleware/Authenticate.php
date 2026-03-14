<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        $path = trim($request->path(), '/');

        if (str_starts_with($path, 'office')) {
            return url('office/login');
        }

        if (str_starts_with($path, 'admin')) {
            return url('admin/login');
        }

        return url('/');
    }
}
