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
        // Add some debugging
        \Log::info('Enrollment attempt for course: ' . $course->id);
        \Log::info('Request data: ', $request->all());

        $validated = $request->validate([
            'phone' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string'],
            'payment_method' => ['required', 'in:credit_card,paypal,bank_transfer'],
        ]);

        // Handle authentication differently for guests vs logged in users
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            // For guests, validate additional fields
            $additionalValidation = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed', 'min:8'],
            ]);

            // Create new user
            $user = User::create([
                'name' => $additionalValidation['name'],
                'email' => $additionalValidation['email'],
                'password' => bcrypt($additionalValidation['password']),
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

        try {
            $enrollment = CourseEnrollment::create([
                'course_id' => $course->id,
                'user_id' => $user->id,
                'phone' => $validated['phone'] ?? null,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending',
                'notes' => $validated['notes'] ?? null,
                'enrolled_at' => now(),
            ]);

            \Log::info('Enrollment created successfully: ' . $enrollment->id);
            
            return redirect()->route('courses.show', $course)
                ->with('success', 'You have successfully enrolled in this course! Your enrollment is pending payment confirmation.');
                
        } catch (\Exception $e) {
            \Log::error('Enrollment failed: ' . $e->getMessage());
            return back()->with('error', 'There was an error processing your enrollment. Please try again.');
        }
    }
}
