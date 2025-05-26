<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\LearningPoint;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CoursesAdminController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::with(['designer', 'category'])
                        ->orderByDesc('created_at')
                        ->paginate(10);
        
        return view('admin.courses.index', compact('courses'));
    }
    
    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        $categories = Category::all();
        $designers = User::where('role', 'designer')->get();
        
        return view('admin.courses.create', compact('categories', 'designers'));
    }
    
    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'designer_id' => 'nullable|exists:users,id',  // Changed from 'required' to 'nullable'
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'video_url' => 'nullable|url',
            'preview_url' => 'nullable|url',
            'duration' => 'nullable|string',
            'lessons_count' => 'nullable|integer|min:0',
            'level' => 'nullable|string',
            'language' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'nullable|date',
            'learning_points' => 'nullable|array',
            'learning_points.*' => 'required|string|max:255',
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }
        
        // Create course
        $course = Course::create($validated);
        
        // Create learning points
        if (isset($validated['learning_points'])) {
            foreach ($validated['learning_points'] as $description) {
                $course->learningPoints()->create(['description' => $description]);
            }
        }
        
        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course created successfully!');
    }
    
    /**
     * Display the specified course.
     */
    public function show(Course $course)
    {
        $course->load(['designer', 'category', 'learningPoints', 'enrolledUsers']);
        
        return view('admin.courses.show', compact('course'));
    }
    
    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $designers = User::where('role', 'designer')->get();
        $learningPoints = $course->learningPoints;
        
        return view('admin.courses.edit', compact('course', 'categories', 'designers', 'learningPoints'));
    }
    
    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'designer_id' => 'nullable|exists:users,id', // Changed from 'required' to 'nullable'
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'video_url' => 'nullable|url',
            'preview_url' => 'nullable|url',
            'duration' => 'nullable|string',
            'lessons_count' => 'nullable|integer|min:0',
            'level' => 'nullable|string',
            'language' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'nullable|date',
            'learning_points' => 'nullable|array',
            'learning_points.*' => 'required|string|max:255',
            'existing_learning_points' => 'nullable|array',
            'existing_learning_points.*' => 'nullable|string|max:255',
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            
            $path = $request->file('image')->store('courses', 'public');
            $validated['image'] = $path;
        }
        
        // Update course
        $course->update($validated);
        
        // Update existing learning points
        if (isset($validated['existing_learning_points'])) {
            foreach ($validated['existing_learning_points'] as $id => $description) {
                if ($description) {
                    LearningPoint::where('id', $id)->update(['description' => $description]);
                } else {
                    LearningPoint::where('id', $id)->delete();
                }
            }
        }
        
        // Add new learning points
        if (isset($validated['learning_points'])) {
            foreach ($validated['learning_points'] as $description) {
                $course->learningPoints()->create(['description' => $description]);
            }
        }
        
        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course updated successfully!');
    }
    
    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        // Delete image if exists
        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }
        
        // Learning points will be automatically deleted due to the cascade relationship
        $course->delete();
        
        return redirect()->route('admin.courses.index')
                        ->with('success', 'Course deleted successfully!');
    }
    
    /**
     * Update learning points for a course.
     */
    public function updateLearningPoints(Request $request, Course $course)
    {
        $validated = $request->validate([
            'learning_points' => 'required|array',
            'learning_points.*' => 'required|string|max:255',
        ]);
        
        // Delete existing learning points
        $course->learningPoints()->delete();
        
        // Create new learning points
        foreach ($validated['learning_points'] as $description) {
            $course->learningPoints()->create(['description' => $description]);
        }
        
        return redirect()->route('admin.courses.edit', $course)
                        ->with('success', 'Learning points updated successfully!');
    }
}