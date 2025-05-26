@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">الكورسات المتاحة</h1>
    
    <!-- فلاتر البحث -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('courses.index') }}">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="search">بحث:</label>
                        <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="ابحث عن عنوان أو وصف...">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="category">الفئة:</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">جميع الفئات</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="designer">المصمم:</label>
                        <select name="designer" id="designer" class="form-control">
                            <option value="">جميع المصممين</option>
                            @foreach($designers as $designer)
                                <option value="{{ $designer->id }}" {{ request('designer') == $designer->id ? 'selected' : '' }}>{{ $designer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="price">السعر:</label>
                        <select name="price" id="price" class="form-control">
                            <option value="">الترتيب الافتراضي</option>
                            <option value="low" {{ request('price') == 'low' ? 'selected' : '' }}>من الأقل إلى الأعلى</option>
                            <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>من الأعلى إلى الأقل</option>
                        </select>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">تطبيق الفلاتر</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">إعادة ضبط</a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- إنشاء كورس جديد للمصممين -->
    @auth
        @if(auth()->user()->is_designer)
            <div class="text-left mb-4">
                <a href="{{ route('courses.create') }}" class="btn btn-success">إنشاء كورس جديد</a>
                <a href="{{ route('courses.my-courses') }}" class="btn btn-info">كورساتي</a>
            </div>
        @endif
    @endauth
    
    <!-- عرض الكورسات -->
    @if($courses->count() > 0)
        <div class="row">
            @foreach($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span>لا توجد صورة</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                                <span class="font-weight-bold">{{ $course->price }} د.أ</span>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <small>المصمم: <a href="{{ route('courses.by-designer', $course->designer_id) }}">{{ $course->designer->name }}</a></small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- ترقيم الصفحات -->
        <div class="d-flex justify-content-center">
            {{ $courses->appends(request()->query())->links() }}
        </div>
    @else
        <div class="alert alert-info">
            لا توجد كورسات متاحة حاليًا.
        </div>
    @endif
</div>
@endsection