<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function create(Course $course)
    {
        return view('courses.enroll', compact('course'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string'
        ]);

        Enrollment::create([
            'user_id' => Auth::user()->id,
            'course_id' => $validated['course_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'notes' => $validated['notes'],
            'status' => 'pending'
        ]);

        return redirect()->route('courses.index')
            ->with('success', 'تم تسجيلك في الدورة بنجاح، سنتواصل معك قريباً!');
    }
}