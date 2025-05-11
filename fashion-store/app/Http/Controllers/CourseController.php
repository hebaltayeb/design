<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
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

    public function show($id)
    {
        $course = Course::with('designer', 'category')->findOrFail($id);

        // جلب دورات مشابهة من نفس الفئة باستثناء الدورة الحالية
        $relatedCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->take(3)
            ->get();

        return view('courses.course-details', compact('course', 'relatedCourses'));
    }

    public function enroll(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // جلب الدورة بناءً على المعرف
        $course = Course::findOrFail($id);
        
        // إذا كان المستخدم مسجل دخول استخدم معرف المستخدم الحالي
        $userId = Auth::check() ? Auth::id() : null;
        
        // في حالة المستخدم غير المسجل دخول، يمكن تخزين بياناته كـ "مستخدم ضيف"
        if (!$userId) {
            // يمكن حفظ البيانات في جدول منفصل للمستخدمين غير المسجلين، إذا كنت ترغب في ذلك
            // مثال: حفظ البيانات في جدول `guest_enrollments`
        }

        // انشاء تسجيل دورة جديد
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
