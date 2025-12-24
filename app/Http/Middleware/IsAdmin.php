<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
     public function handle($request, Closure $next)
    {
        if (!auth()->check() || !in_array(auth()->user()->role, ['admin','masteradmin'])) {
            abort(403);
        }
        return $next($request);
    }
}
