@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">تعديل الكورس: {{ $course->title }}</h1>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('courses.update', $course->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- نفس محتوى نموذج الإنشاء مع تعبئة القيم الحالية للكورس -->
                <!-- يتم استبدال old('field') بـ old('field', $course->field) -->
                
                <!-- على سبيل المثال: -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">عنوان الكورس *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $course->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- باقي الحقول بنفس النمط -->
                </div>
                
                <!-- إذا كانت هناك صورة موجودة، عرضها -->
                @if($course->image)
                    <div class="form-group">
                        <label>الصورة الحالية:</label>
                        <div>
                            <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" style="max-width: 200px; max-height: 200px;">
                        </div>
                    </div>
                @endif
                
                <!-- عرض نقاط التعلم الحالية -->
                <div class="form-group">
                    <label>نقاط التعلم (ماذا سيتعلم الطلاب)</label>
                    <div id="learning-points-container">
                        @forelse($course->learningPoints as $index => $point)
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="learning_points[]" value="{{ $point->description }}" placeholder="أدخل نقطة تعلم">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-danger remove-point" {{ $index === 0 && $course->learningPoints->count() === 1 ? 'disabled' : '' }}>حذف</button>
                                </div>
                            </div>
                        @empty
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="learning_points[]" placeholder="أدخل نقطة تعلم">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-danger remove-point" disabled>حذف</button>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-learning-point">إضافة نقطة تعلم</button>
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">تحديث الكورس</button>
                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // نفس السكربت الموجود في قالب الإنشاء
</script>
@endsection
@endsection