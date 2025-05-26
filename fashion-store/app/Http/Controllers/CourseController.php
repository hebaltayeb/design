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
    public function __construct()
    {
        // تطبيق middleware للتحقق من أن المستخدم مصمم لوظائف الإنشاء والتعديل والحذف
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('designer')->only(['create', 'store', 'edit', 'update', 'destroy', 'myDesignerCourses']);
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $designers = User::where('is_designer', true)->get();
    
        $query = Course::query()->with('designer');
    
        // البحث عن الدورات
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
            });
        }
    
        // التصفية حسب الفئة
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }
    
        // التصفية حسب المصمم
        if ($request->has('designer') && $request->designer) {
            $query->where('designer_id', $request->designer);
        }
    
        // التصفية حسب السعر
        if ($request->has('price')) {
            if ($request->price == 'low') {
                $query->orderBy('price', 'asc');
            } elseif ($request->price == 'high') {
                $query->orderBy('price', 'desc');
            }
        }
    
        $courses = $query->paginate(6);
    
        return view('courses.index', compact('courses', 'categories', 'designers'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
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
            ->with('success', 'تم إنشاء الكورس بنجاح!');
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

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        if (Auth::id() !== $course->designer_id) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'ليس لديك صلاحية تعديل هذا الكورس.');
        }

        $categories = Category::all();
        return view('courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        if (Auth::id() !== $course->designer_id) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'ليس لديك صلاحية تعديل هذا الكورس.');
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
            ->with('success', 'تم تحديث الكورس بنجاح!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if (Auth::id() !== $course->designer_id) {
            return redirect()->route('courses.show', $course)
                ->with('error', 'ليس لديك صلاحية حذف هذا الكورس.');
        }

        if ($course->image) {
            Storage::disk('public')->delete($course->image);
        }

        $course->learningPoints()->delete();
        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', 'تم حذف الكورس بنجاح!');
    }

    public function myDesignerCourses()
    {
        $courses = Course::where('designer_id', Auth::id())
            ->with('category')
            ->latest()
            ->paginate(10);
            
        return view('courses.designer-courses', compact('courses'));
    }

    public function coursesByDesigner($designerId)
    {
        $designer = User::where('is_designer', true)->findOrFail($designerId);
        
        $courses = Course::where('designer_id', $designerId)
            ->with('category')
            ->latest()
            ->paginate(6);
            
        return view('courses.designer-courses', compact('courses', 'designer'));
    }

    public function enroll(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $course = Course::findOrFail($id);
        
        $userId = Auth::check() ? Auth::id() : null;
        
        $enrollment = new Enrollment();
        $enrollment->course_id = $course->id;
        $enrollment->user_id = $userId;
        $enrollment->name = $request->name;
        $enrollment->email = $request->email;
        $enrollment->phone = $request->phone;
        $enrollment->payment_status = 'pending';
        $enrollment->save();
        
        return redirect()->back()->with('success', 'تم تسجيلك في الدورة بنجاح!');
    }
}