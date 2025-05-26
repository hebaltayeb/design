<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AuthAdmin;

class SuperAdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $authController = new AuthAdmin();
        
        if (!$authController->checkSuperAdminAuth($request)) {
            // Redirect to regular admin dashboard if they're admin but not superadmin
            if ($authController->checkAdminAuth($request)) {
                return redirect('/admin/dashboard')->with('error', 'Superadmin access required.');
            }
            
            return redirect('/admin/login');
        }

        return $next($request);
    }
}