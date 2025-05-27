<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;

class AuthAdmin extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle admin login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();
            
            // Check if user has admin access (admin or superadmin)
            if (!$user->hasAdminAccess()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Access denied. Admin privileges required.',
                ]);
            }

            $request->session()->regenerate();

            // Set admin authentication cookie
            $adminToken = hash('sha256', $user->id . now() . config('app.key'));
            
            // Store admin session data
            session([
                'admin_authenticated' => true,
                'admin_id' => $user->id,
                'admin_role' => $user->role, // Store specific role
                'admin_token' => $adminToken
            ]);

            // Set secure cookie
            $cookie = cookie(
                'admin_auth_token', 
                $adminToken, 
                60 * 24 * 7, // 7 days
                '/', 
                null, 
                true, // secure
                true  // httpOnly
            );

            // Redirect to dashboard
            return redirect()
                ->intended('/dashboard')
                ->withCookie($cookie);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Handle admin logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear admin session data
        $request->session()->forget(['admin_authenticated', 'admin_id', 'admin_role', 'admin_token']);

        // Clear admin cookie
        $cookie = cookie(
            'admin_auth_token', 
            '', 
            -1, // expire immediately
            '/', 
            null, 
            true, 
            true
        );

        return redirect('/admin/login')->withCookie($cookie);
    }

    /**
     * Check if admin is authenticated via cookie.
     */
    public function checkAdminAuth(Request $request)
    {
        $token = $request->cookie('admin_auth_token');
        $sessionToken = session('admin_token');
        $adminId = session('admin_id');

        if (!$token || !$sessionToken || $token !== $sessionToken || !$adminId) {
            return false;
        }

        // Verify admin user still exists and has admin access
        $admin = User::find($adminId);
        return $admin && $admin->hasAdminAccess();
    }

    /**
     * Check if user has superadmin access.
     */
    public function checkSuperAdminAuth(Request $request)
    {
        if (!$this->checkAdminAuth($request)) {
            return false;
        }

        $adminId = session('admin_id');
        $admin = User::find($adminId);
        
        return $admin && $admin->isSuperAdmin();
    }
}