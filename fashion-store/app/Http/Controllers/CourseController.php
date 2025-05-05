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

    // جلب الدورات بناءً على الفلاتر والبحث
    $courses = Course::query()
        ->when($request->input('search'), function ($query, $search) {
            return $query->where('title', 'like', "%$search%");
        })
        ->when($request->input('category'), function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })
        ->get();

    return view('courses.index', compact('courses', 'categories'));

        $courses = Course::with('designer')->get(); // assuming 'designer' is the relation to User
    return view('courses.index', compact('courses'));
        $query = Course::query()->with('designer');
        
        // البحث عن الدورات
        if ($request->has('search')) {
            $query->where('title', 'LIKE', '%' . $request->search . '%')
                ->orWhere('description', 'LIKE', '%' . $request->search . '%');
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
        $designers = User::where('is_designer', true)->get();
        
        return view('courses.index', compact('courses', 'designers'));
    }
    
    public function show($id)
    {
        $course = Course::with('designer')->findOrFail($id);
        return view('courses.coursdetals', compact('course'));
    }
    
    public function enroll(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $course = Course::findOrFail($id);
        
        // إذا كان المستخدم مسجل دخول استخدم معرف المستخدم الحالي
        $userId = Auth::check() ? Auth::id() : null;
        
        // انشاء تسجيل دورة جديد
        $enrollment = new Enrollment();
        $enrollment->course_id = $course->id;
        $enrollment->user_id = $userId;
        $enrollment->payment_status = 'pending';
        $enrollment->save();
        
        // حفظ معلومات الاتصال الإضافية بطريقة مناسبة
        // يمكن إضافة جدول إضافي لتخزين معلومات التسجيل للمستخدمين غير المسجلين
        
        return redirect()->back()->with('success', 'تم تسجيلك في الدورة بنجاح!');
    }
    
}