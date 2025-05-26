<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('designer_id', Auth::id())
            ->with(['category', 'enrollments'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $courses,
            'success' => true
        ]);
    }

    public function create()
    {
        return view('designer.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'level' => 'required|string',
            'lessons_count' => 'nullable|integer|min:1',
            'language' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'preview_url' => 'nullable|url',
            'start_date' => 'nullable|date',
        ]);

        $data['designer_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($data);

        return redirect()->route('designer.dashboard')
            ->with('success', 'Course added successfully!');
    }

    public function show(Course $course)
    {
        $this->authorizeCourse($course);

        $course->load(['category', 'enrollments.user']);

        return response()->json($course);
    }

    public function edit(Course $course)
    {
        $this->authorizeCourse($course);

        return view('designer.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorizeCourse($course);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'level' => 'required|string',
            'lessons_count' => 'nullable|integer|min:1',
            'language' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url',
            'preview_url' => 'nullable|url',
            'start_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('designer.dashboard')
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $this->authorizeCourse($course);

        // Delete image if exists
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();

        return redirect()->route('designer.dashboard')
            ->with('success', 'Course deleted successfully!');
    }

    private function authorizeCourse(Course $course)
    {
        if ($course->designer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
