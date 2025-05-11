<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    // إرسال رابط استرجاع كلمة المرور
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // إرسال رابط إعادة تعيين كلمة المرور
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', 'We have emailed your password reset link!');
        } else {
            return back()->withErrors(['email' => 'Unable to send reset link']);
        }
    }
}

