<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // استيراد Facade Auth
use Symfony\Component\HttpFoundation\Response;

class DesignerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->is_designer) {
            return $next($request);
        }

        abort(403, 'Unauthorized - You must be a designer to access this page.');
    }
}
