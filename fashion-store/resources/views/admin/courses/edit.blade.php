@extends('layouts.admin')

@section('title', 'Edit Course')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Edit Course: {{ $course->title }}</h1>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Back to Courses
        </a>
    </div>
    
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-graduation-cap me-1"></i>
            Course Details
        </div>
        <div class="card-body">
            <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $course->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="designer_id" class="form-label">Designer</label>
                            <select class="form-select @error('designer_id') is-invalid @enderror" id="designer_id" name="designer_id">
                                <option value="">Select Designer</option>
                                @foreach($designers as $designer)
                                    <option value="{{ $designer->id }}" {{ old('designer_id', $course->designer_id) == $designer->id ? 'selected' : '' }}>
                                        {{ $designer->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('designer_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $course->price) }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Short Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description', $course->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="full_description" class="form-label">Full Description</label>
                    <textarea class="form-control summernote @error('full_description') is-invalid @enderror" id="full_description" name="full_description">{{ old('full_description', $course->full_description) }}</textarea>
                    @error('full_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="video_url" class="form-label">Video URL</label>
                            <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url', $course->video_url) }}">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="preview_url" class="form-label">Preview URL</label>
                            <input type="url" class="form-control @error('preview_url') is-invalid @enderror" id="preview_url" name="preview_url" value="{{ old('preview_url', $course->preview_url) }}">
                            @error('preview_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $course->duration) }}" placeholder="e.g. 4 weeks">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="lessons_count" class="form-label">Number of Lessons</label>
                            <input type="number" min="0" class="form-control @error('lessons_count') is-invalid @enderror" id="lessons_count" name="lessons_count" value="{{ old('lessons_count', $course->lessons_count) }}">
                            @error('lessons_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $course->start_date ? $course->start_date->format('Y-m-d') : '') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                                <option value="">Select Level</option>
                                <option value="Beginner" {{ old('level', $course->level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('level', $course->level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ old('level', $course->level) == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                <option value="All Levels" {{ old('level', $course->level) == 'All Levels' ? 'selected' : '' }}>All Levels</option>
                            </select>
                            @error('level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="language" class="form-label">Language</label>
                            <select class="form-select @error('language') is-invalid @enderror" id="language" name="language">
                                <option value="">Select Language</option>
                                <option value="English" {{ old('language', $course->language) == 'English' ? 'selected' : '' }}>English</option>
                                <option value="Arabic" {{ old('language', $course->language) == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                                <option value="French" {{ old('language', $course->language) == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Spanish" {{ old('language', $course->language) == 'Spanish' ? 'selected' : '' }}>Spanish</option>
                            </select>
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Course Image</label>
                    @if($course->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    <small class="text-muted">Leave empty to keep current image. Recommended size: 1200x800 pixels, max 2MB</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-list-ul me-1"></i> Existing Learning Points</span>
                    </div>
                    <div class="card-body">
                        @forelse($learningPoints as $point)
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                <input type="text" class="form-control" name="existing_learning_points[{{ $point->id }}]" value="{{ $point->description }}">
                                <button type="button" class="btn btn-outline-danger remove-learning-point">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @empty
                            <p class="text-muted">No learning points available.</p>
                        @endforelse
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-plus-circle me-1"></i> Add New Learning Points</span>
                        <button type="button" class="btn btn-sm btn-success" id="addLearningPoint">
                            <i class="fas fa-plus"></i> Add Point
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="learningPointsContainer">
                            <!-- New learning points will be added here -->
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary me-md-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        // Add learning point
        $('#addLearningPoint').click(function() {
            $('#learningPointsContainer').append(`
                <div class="input-group mb-2">
                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                    <input type="text" class="form-control" name="learning_points[]" placeholder="What students will learn...">
                    <button type="button" class="btn btn-outline-danger remove-learning-point">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `);
        });
        
        // Remove learning point
        $(document).on('click', '.remove-learning-point', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endsection