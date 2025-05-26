@extends('layouts.app')

@section('content')
<div class="container">
    @if(isset($designer))
        <h1 class="mb-4">كورسات المصمم: {{ $designer->name }}</h1>
    @else
        <h1 class="mb-4">كورساتي</h1>
        <div class="mb-4">
            <a href="{{ route('courses.create') }}" class="btn btn-success">إنشاء كورس جديد</a>
        </div>
    @endif
    
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
                            
                            @if($course->category)
                                <p><span class="badge badge-info">{{ $course->category->name }}</span></p>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">عرض التفاصيل</a>
                                <span class="font-weight-bold">{{ $course->price }} د.أ</span>
                            </div>
                        </div>
                        
                        @if(auth()->check() && auth()->id() === $course->designer_id)
                            <div class="card-footer">
                                <div class="btn-group btn-group-sm w-100">
                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">تعديل</a>
                                    <form method="POST" action="{{ route('courses.destroy', $course->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا الكورس؟');" class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100">حذف</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $courses->links() }}
        </div>
    @else
        <div class="alert alert-info">
            لا توجد كورسات متاحة حاليًا.
        </div>
    @endif
</div>
@endsection