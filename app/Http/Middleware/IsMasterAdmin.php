<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsMasterAdmin
{
       public function handle($request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role !== 'masteradmin') {
            abort(403);
        }
        return $next($request);
    }
}
