@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">إنشاء كورس جديد</h1>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">عنوان الكورس *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">السعر (د.أ) *</label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">وصف مختصر *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="full_description">وصف تفصيلي</label>
                    <textarea class="form-control @error('full_description') is-invalid @enderror" id="full_description" name="full_description" rows="6">{{ old('full_description') }}</textarea>
                    @error('full_description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id">الفئة *</label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">اختر الفئة</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="level">المستوى</label>
                            <select class="form-control @error('level') is-invalid @enderror" id="level" name="level">
                                <option value="">اختر المستوى</option>
                                <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>مبتدئ</option>
                                <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>متوسط</option>
                                <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>متقدم</option>
                            </select>
                            @error('level')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duration">مدة الكورس (بالساعات)</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration') }}">
                            @error('duration')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lessons_count">عدد الدروس</label>
                            <input type="number" class="form-control @error('lessons_count') is-invalid @enderror" id="lessons_count" name="lessons_count" value="{{ old('lessons_count') }}">
                            @error('lessons_count')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="language">لغة الكورس</label>
                            <input type="text" class="form-control @error('language') is-invalid @enderror" id="language" name="language" value="{{ old('language') }}">
                            @error('language')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">تاريخ بداية الكورس</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
                            @error('start_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="video_url">رابط الفيديو التعريفي</label>
                            <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url') }}">
                            @error('video_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="preview_url">رابط فيديو المعاينة</label>
                            <input type="url" class="form-control @error('preview_url') is-invalid @enderror" id="preview_url" name="preview_url" value="{{ old('preview_url') }}">
                            @error('preview_url')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="image">صورة الكورس</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>نقاط التعلم (ماذا سيتعلم الطلاب)</label>
                    <div id="learning-points-container">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="learning_points[]" placeholder="أدخل نقطة تعلم">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-danger remove-point" disabled>حذف</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-learning-point">إضافة نقطة تعلم</button>
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">إنشاء الكورس</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('learning-points-container');
        const addButton = document.getElementById('add-learning-point');
        
        // إضافة نقطة تعلم جديدة
        addButton.addEventListener('click', function() {
            const pointDiv = document.createElement('div');
            pointDiv.className = 'input-group mb-2';
            pointDiv.innerHTML = `
                <input type="text" class="form-control" name="learning_points[]" placeholder="أدخل نقطة تعلم">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-danger remove-point">حذف</button>
                </div>
            `;
            container.appendChild(pointDiv);
            
            // تفعيل زر الحذف لأول نقطة إذا كان هناك أكثر من نقطة واحدة
            if (container.children.length > 1) {
                container.querySelector('.remove-point[disabled]')?.removeAttribute('disabled');
            }
        });
        
        // حذف نقطة تعلم
        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-point') && !e.target.disabled) {
                e.target.closest('.input-group').remove();
                
                // تعطيل زر الحذف للنقطة الأولى إذا أصبحت وحيدة
                if (container.children.length === 1) {
                    container.querySelector('.remove-point').setAttribute('disabled', '');
                }
            }
        });
    });
</script>
@endsection
@endsection