<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DownForMaintenanceMW
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Prevent infinite redirect loop
        if ($request->is('maintenance')) {
            return $next($request);
        }
    
        if (env('APP_ENV') === 'local') {
            return redirect('/maintenance');
        }
    
        return $next($request);
    }
}