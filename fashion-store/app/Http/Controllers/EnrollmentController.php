<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseEnrollment;


class EnrollmentController extends Controller
{
    // عرض صفحة التسجيل في دورة
    public function create(Course $course)
    {
        return view('courses.enrollment', compact('course'));
    }
    
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'phone' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string'],
            'payment_method' => ['required', 'in:credit_card,paypal,bank_transfer'],
            'password' => ['required_without:user_id', 'confirmed'],
            'name' => ['required_without:user_id'],
            'email' => ['required_without:user_id', 'email'],
        ]);
    
        if (Auth::check()) {
            // مستخدم مسجل الدخول
            $user = Auth::user();
        } else {
            // Check if user exists with this email
            $existingUser = User::where('email', $validated['email'])->first();
            
            if ($existingUser) {
                return back()->withErrors(['email' => 'An account with this email already exists. Please login first.']);
            }
            
            // مستخدم جديد، نُنشئ حساب له
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);
    
            Auth::login($user);
        }

        // Check if already enrolled
        $existingEnrollment = CourseEnrollment::where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingEnrollment) {
            return back()->with('error', 'You are already enrolled in this course!');
        }

        $enrollment = CourseEnrollment::create([
            'course_id' => $course->id,
            'user_id' => $user->id,
            'phone' => $validated['phone'] ?? null,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
            'enrolled_at' => now(),
        ]);
        
        return redirect()->route('courses.show', $course)
            ->with('success', 'You have successfully enrolled in this course. Your enrollment is pending payment confirmation.');
    }
}
