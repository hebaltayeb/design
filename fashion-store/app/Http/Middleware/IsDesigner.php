<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsDesigner
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Check both admin and designer guards
        if (Auth::guard('admin')->check() && Auth::guard('designer')->check()) {

            $adminUser = Auth::guard('admin')->user();
            $designerUser = Auth::guard('designer')->user();

            // Ensure roles match
            if ($adminUser->role === 'admin' && ($designerUser->role === 'designer' || $designerUser->is_designer)) {
                return $next($request);
            } else {
                abort(403, 'Access denied: You must be both an admin and a designer.');
            }
        }

        return redirect()->route('login')->with('warning', 'You must be logged in as both admin and designer.');
    }
}
