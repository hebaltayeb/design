@extends('layouts.admin')

@section('title', $course->title)

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Course Details</h1>
        <div>
            <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit me-1"></i> Edit Course
            </a>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Courses
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Course Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>{{ $course->title }}</h2>
                            <p class="text-muted">
                                <strong>Designer:</strong> {{ $course->designer->name ?? 'Unknown' }} |
                                <strong>Category:</strong> {{ $course->category->name ?? 'Uncategorized' }} |
                                <strong>Created:</strong> {{ $course->created_at->format('M d, Y') }}
                            </p>
                            
                            <div class="mb-3">
                                <strong>Description:</strong>
                                <p>{{ $course->description }}</p>
                            </div>
                            
                            @if($course->full_description)
                            <div class="mb-3">
                                <strong>Full Description:</strong>
                                <div>{!! $course->full_description !!}</div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded">
                            @else
                            <div class="bg-light p-5 text-center rounded">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="mt-2">No image available</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="d-block fw-bold"><i class="fas fa-tag"></i> Price</span>
                                <span class="badge bg-success fs-6">${{ number_format($course->price, 2) }}</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="d-block fw-bold"><i class="fas fa-clock"></i> Duration</span>
                                {{ $course->duration ?? 'Not specified' }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="d-block fw-bold"><i class="fas fa-book"></i> Lessons</span>
                                {{ $course->lessons_count ?? 'Not specified' }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="d-block fw-bold"><i class="fas fa-calendar"></i> Start Date</span>
                                {{ $course->start_date ? $course->start_date->format('M d, Y') : 'Not specified' }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="d-block fw-bold"><i class="fas fa-signal"></i> Level</span>
                                {{ $course->level ?? 'Not specified' }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="d-block fw-bold"><i class="fas fa-language"></i> Language</span>
                                {{ $course->language ?? 'Not specified' }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span class="d-block fw-bold"><i class="fas fa-film"></i> Videos</span>
                                @if($course->video_url)
                                    <a href="{{ $course->video_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-play-circle"></i> Main Video
                                    </a>
                                @endif
                                
                                @if($course->preview_url)
                                    <a href="{{ $course->preview_url }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i> Preview
                                    </a>
                                @endif
                                
                                @if(!$course->video_url && !$course->preview_url)
                                    <span class="text-muted">No videos available</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-list-check me-1"></i> Learning Points
                </div>
                <div class="card-body">
                    @if($course->learningPoints->count() > 0)
                        <ul class="list-group">
                            @foreach($course->learningPoints as $point)
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    {{ $point->description }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No learning points specified for this course.</p>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-users me-1"></i> Students Enrolled ({{ $course->enrolledUsers->count() }})
                </div>
                <div class="card-body">
                    @if($course->enrolledUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Enrolled On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->enrolledUsers as $user)
                                        <tr>
                                            <td>
                                                {{ $user->name }}
                                                <small class="d-block text-muted">{{ $user->email }}</small>
                                            </td>
                                            <td>{{ $user->pivot->enrolled_at ? date('M d, Y', strtotime($user->pivot->enrolled_at)) : 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                            <p>No students enrolled yet.</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer text-end">
                    <a href="#" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-download me-1"></i> Export Students
                    </a>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-link me-1"></i> Quick Links
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('courses.show', $course->id) }}" target="_blank" class="list-group-item list-group-item-action">
                            <i class="fas fa-external-link-alt me-2"></i> View Public Course Page
                        </a>
                        <a href="{{ route('admin.courses.edit', $course) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit me-2"></i> Edit Course Details
                        </a>
                        <button type="button" class="list-group-item list-group-item-action text-danger" data-bs-toggle="modal" data-bs-target="#deleteCourseModal">
                            <i class="fas fa-trash me-2"></i> Delete Course
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCourseModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the course <strong>"{{ $course->title }}"</strong>?</p>
                <p class="text-danger">This action cannot be undone and will remove all associated learning points and enrollments.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Course</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection