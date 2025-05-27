<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\LearningPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $designers = User::where('is_designer', true)->get();
    
        $query = Course::query()->with('designer');
    
        // Search courses
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }
    
        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
    
        // Filter by designer
        if ($request->has('designer') && $request->designer) {
            $query->where('designer_id', $request->designer);
        }
    
        // Filter by price
        if ($request->has('price')) {
            if ($request->price == 'low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->price == 'high') {
                $query->orderBy('price', 'desc');
            }
        }
    
        $courses = $query->paginate(9);
    
        return view('courses.index', compact('courses', 'categories', 'designers'));
    }

    public function show($id)
    {
        $course = Course::with(['designer', 'category', 'learningPoints'])->findOrFail($id);

        $relatedCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->take(3)
            ->get();

        return view('courses.course-details', compact('course', 'relatedCourses'));
    }

    // Only authenticated users can create/edit courses
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'video_url' => 'nullable|url',
            'preview_url' => 'nullable|url',
            'duration' => 'nullable|integer|min:1',
            'lessons_count' => 'nullable|integer|min:0',
            'level' => 'nullable|string|in:beginner,intermediate,advanced',
            'language' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }

        $validated['designer_id'] = Auth::id();

        $course = Course::create($validated);

        if ($request->has('learning_points') && is_array($request->learning_points)) {
            foreach ($request->learning_points as $point) {
                if (!empty($point)) {
                    $course->learningPoints()->create(['description' => $point]);
                }
            }
        }

        return redirect()->route('courses.show', $course)
            ->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $course = Course::findOrFail($id);

        if (Auth::id() !== $course->designer_id) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to edit this course.');
        }

        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $course = Course::findOrFail($id);

        if (Auth::id() !== $course->designer_id) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to edit this course.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'video_url' => 'nullable|url',
            'preview_url' => 'nullable|url',
            'duration' => 'nullable|integer|min:1',
            'lessons_count' => 'nullable|integer|min:0',
            'level' => 'nullable|string|in:beginner,intermediate,advanced',
            'language' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }

        $course->update($validated);

        if ($request->has('learning_points') && is_array($request->learning_points)) {
            $course->learningPoints()->delete();
            
            foreach ($request->learning_points as $point) {
                if (!empty($point)) {
                    $course->learningPoints()->create(['description' => $point]);
                }
            }
        }

        return redirect()->route('courses.show', $course)
            ->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $course = Course::findOrFail($id);

        if (Auth::id() !== $course->designer_id) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'You do not have permission to delete this course.');
        }

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->learningPoints()->delete();
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully!');
    }

    // Enrollment method - anyone can enroll (even without account)
    public function enroll(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $course = Course::findOrFail($id);
        
        // Check if already enrolled with this email
        $existingEnrollment = Enrollment::where('course_id', $course->id)
            ->where('email', $request->email)
            ->first();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'You are already enrolled in this course!');
        }
        
        $userId = Auth::check() ? Auth::id() : null;
        
        $enrollment = new Enrollment();
        $enrollment->course_id = $course->id;
        $enrollment->user_id = $userId;
        $enrollment->name = $request->name;
        $enrollment->email = $request->email;
        $enrollment->phone = $request->phone;
        $enrollment->payment_status = 'pending';
        $enrollment->save();
        
        return redirect()->back()->with('success', 'Successfully enrolled! Please proceed with payment.');
    }
}