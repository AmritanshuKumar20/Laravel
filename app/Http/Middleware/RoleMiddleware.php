<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user is authenticated and if their role matches one of the specified roles
        if (!in_array(auth()->user()->role, $roles)) {
            // If the role doesn't match, abort with a 403 Unauthorized status
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
