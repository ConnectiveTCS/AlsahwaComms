<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        if (!Auth::user()->roles()->whereIn('name', $roles)->exists()) {
            abort(403, 'Unauthorized - Insufficient Role');
        }

        return $next($request);
    }
}
