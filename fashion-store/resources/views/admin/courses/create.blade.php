@extends('layouts.admin')

@section('title', 'Create New Course')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Create New Course</h1>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Back to Courses
        </a>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-graduation-cap me-1"></i>
            Course Details
        </div>
        <div class="card-body">
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
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
                                    <option value="{{ $designer->id }}" {{ old('designer_id') == $designer->id ? 'selected' : '' }}>
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
                        <div class="mb-3">t>
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                <input type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="video_url" class="form-label">Video URL</label>
                            <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url') }}">
                            @error('video_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="preview_url" class="form-label">Preview URL</label>
                            <input type="url" class="form-control @error('preview_url') is-invalid @enderror" id="preview_url" name="preview_url" value="{{ old('preview_url') }}">
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
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration') }}" placeholder="e.g. 4 weeks">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="lessons_count" class="form-label">Number of Lessons</label>
                            <input type="number" min="0" class="form-control @error('lessons_count') is-invalid @enderror" id="lessons_count" name="lessons_count" value="{{ old('lessons_count') }}">
                            @error('lessons_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date') }}">
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
                                <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ old('level') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                <option value="All Levels" {{ old('level') == 'All Levels' ? 'selected' : '' }}>All Levels</option>
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
                                <option value="English" {{ old('language') == 'English' ? 'selected' : '' }}>English</option>
                                <option value="Arabic" {{ old('language') == 'Arabic' ? 'selected' : '' }}>Arabic</option>
                                <option value="French" {{ old('language') == 'French' ? 'selected' : '' }}>French</option>
                                <option value="Spanish" {{ old('language') == 'Spanish' ? 'selected' : '' }}>Spanish</option>
                            </select>
                            @error('language')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Course Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    <small class="text-muted">Recommended size: 1200x800 pixels, max 2MB</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-list-ul me-1"></i> Learning Points</span>
                        <button type="button" class="btn btn-sm btn-success" id="addLearningPoint">
                            <i class="fas fa-plus"></i> Add Point
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="learningPointsContainer">
                            <div class="input-group mb-2">
                                <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                <input type="text" class="form-control" name="learning_points[]" placeholder="What students will learn...">
                                <button type="button" class="btn btn-outline-danger remove-learning-point">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-secondary me-md-2">Reset</button>
                    <button type="submit" class="btn btn-primary">Create Course</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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