<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AuthAdmin;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $authController = new AuthAdmin();
        
        if (!$authController->checkAdminAuth($request)) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}