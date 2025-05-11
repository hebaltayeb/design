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
            'password' => ['required_if:guest,true', 'confirmed'],
            'name' => ['required_if:guest,true'],
            'email' => ['required_if:guest,true', 'email', 'unique:users,email'],
        ]);
    
        if (Auth::check()) {
            // مستخدم مسجل الدخول
            $user = Auth::user();
        } else {
            // مستخدم جديد، نُنشئ حساب له
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
            ]);
    
            Auth::login($user);
        }

        $enrollment = new CourseEnrollment() ;
        $enrollment->course_id = $course->id;
        $enrollment->user_id = $user->id;
        $enrollment->name = $user->name;
        $enrollment->email = $user->email;
        $enrollment->phone = $validated['phone'] ?? null;
        // $enrollment->status = 'pending';
        $enrollment->enrolled_at = now();
        $enrollment->save();
        
        return redirect()->route('courses.show', $course)
            ->with('success', 'You have successfully enrolled in this course. Your enrollment is pending payment confirmation.');
    }
}
