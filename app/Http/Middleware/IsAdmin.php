<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
        public function handle($request, Closure $next)
    {
        abort_unless($request->user->isAdmin(), 403, 'Sorry, you are unauthorized to view this page.');

        return $next($request);
    }
   
}
