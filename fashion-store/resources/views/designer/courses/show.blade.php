@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                @if($course->image)
                    <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top" alt="{{ $course->title }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $course->title }}</h1>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="badge badge-primary">{{ $course->category->name }}</span>
                        <span class="text-success font-weight-bold">{{ $course->price }} د.أ</span>
                    </div>
                    
                    <p class="card-text">{{ $course->description }}</p>
                    
                    @if($course->full_description)
                        <div class="mt-4">
                            <h5>وصف تفصيلي</h5>
                            <div>{!! nl2br(e($course->full_description)) !!}</div>
                        </div>
                    @endif
                    
                    @if($course->video_url)
                        <div class="mt-4">
                            <h5>فيديو تعريفي</h5>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $course->video_url }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    @endif
                    
                    @if($course->learningPoints && $course->learningPoints->count() > 0)
                        <div class="mt-4">
                            <h5>ماذا ستتعلم</h5>
                            <ul class="list-group list-group-flush">
                                @foreach($course->learningPoints as $point)
                                    <li class="list-group-item">{{ $point->description }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="mt-4">
                        <h5>تفاصيل إضافية</h5>
                        <div class="row">
                            @if($course->duration)
                                <div class="col-md-6 mb-2">
                                    <strong>مدة الكورس:</strong> {{ $course->duration }} ساعة
                                </div>
                            @endif
                            
                            @if($course->lessons_count)
                                <div class="col-md-6 mb-2">
                                    <strong>عدد الدروس:</strong> {{ $course->lessons_count }} درس
                                </div>
                            @endif
                            
                            @if($course->level)
                                <div class="col-md-6 mb-2">
                                    <strong>المستوى:</strong> 
                                    @if($course->level == 'beginner')
                                        مبتدئ
                                    @elseif($course->level == 'intermediate')
                                        متوسط
                                    @elseif($course->level == 'advanced')
                                        متقدم
                                    @endif
                                </div>
                            @endif
                            
                            @if($course->language)
                                <div class="col-md-6 mb-2">
                                    <strong>اللغة:</strong> {{ $course->language }}
                                </div>
                            @endif
                            
                            @if($course->start_date)
                                <div class="col-md-6 mb-2">
                                    <strong>تاريخ البدء:</strong> {{ $course->start_date->format('Y-m-d') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @auth
                        @if(auth()->user()->id === $course->designer_id)
                            <div class="mt-4 d-flex">
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning mr-2">تعديل الكورس</a>
                                <form method="POST" action="{{ route('courses.destroy', $course->id) }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا الكورس؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">حذف الكورس</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    معلومات المصمم
                </div>
                <div class="card-body">
                    <h5>{{ $course->designer->name }}</h5>
                    @if($course->designer->bio)
                        <p>{{ Str::limit($course->designer->bio, 150) }}</p>
                    @endif
                    <a href="{{ route('courses.by-designer', $course->designer_id) }}" class="btn btn-outline-primary btn-sm">عرض جميع كورسات المصمم</a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    التسجيل في الكورس
                </div>
                <div class="card-body">
                    <p class="font-weight-bold mb-3">السعر: {{ $course->price }} د.أ</p>
                    
                    <form method="POST" action="{{ route('courses.enroll', $course->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->check() ? auth()->user()->email : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">رقم الهاتف</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="notes">ملاحظات</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">التسجيل الآن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- الكورسات ذات الصلة -->
    @if($relatedCourses->count() > 0)
        <div class="mt-5">
            <h3>كورسات ذات صلة</h3>
            <div class="row">
                @foreach($relatedCourses as $relatedCourse)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($relatedCourse->image)
                                <img src="{{ asset('storage/' . $relatedCourse->image) }}" class="card-img-top" alt="{{ $relatedCourse->title }}" style="height: 180px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 180px;">
                                    <span>لا توجد صورة</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedCourse->title }}</h5>
                                <p class="card-text text-muted">{{ Str::limit($relatedCourse->description, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('courses.show', $relatedCourse->id) }}" class="btn btn-sm btn-primary">عرض التفاصيل</a>
                                    <span class="font-weight-bold">{{ $relatedCourse->price }} د.أ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection