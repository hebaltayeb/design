<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Fashion Design Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'fashion-pink': '#ff6b9d',
                        'fashion-dark': '#c44569',
                        'fashion-gray': '#2c3e50',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-poppins bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <!-- Header with back button -->
    <div class="bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('courses.index') }}" 
                   class="flex items-center space-x-2 text-fashion-gray hover:text-fashion-pink transition-colors duration-300">
                    <i class="fas fa-arrow-left text-lg"></i>
                    <span class="font-medium">Back to Courses</span>
                </a>
                <div class="text-sm text-gray-500">
               
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Course Header -->
        <div class="text-center mb-12">
            <div class="inline-block bg-gradient-to-r from-fashion-pink to-fashion-dark text-white px-6 py-2 rounded-full text-sm font-semibold mb-4">
              
            </div>
            <h1 class="text-4xl md:text-5xl font-light text-fashion-gray mb-6 leading-tight">
                {{ $course->title }}
            </h1>
            
            <!-- Designer Info -->
            <div class="flex items-center justify-center space-x-4 mb-8">
                <img src="{{ $course->designer->profile_image ?? 'https://via.placeholder.com/60' }}" 
                     alt="{{ $course->designer->name }}"
                     class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                <div class="text-left">
                    <h3 class="text-xl font-semibold text-fashion-gray">{{ $course->designer->name }}</h3>
                    <p class="text-gray-600">Fashion Designer & Instructor</p>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Left Column - Course Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Video/Image Section -->
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/20">
                    @if($course->video_url)
                        <div class="relative aspect-video">
                            <iframe 
                                src="{{ $course->video_url }}" 
                                title="{{ $course->title }}"
                                class="w-full h-full"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <img src="{{ $course->image ?? 'https://via.placeholder.com/800x450' }}" 
                             alt="{{ $course->title }}" 
                             class="w-full h-80 object-cover">
                    @endif
                </div>

                <!-- Course Description -->
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
                    <h2 class="text-2xl font-semibold text-fashion-gray mb-6 flex items-center">
                        <i class="fas fa-book-open text-fashion-pink mr-3"></i>
                        Course Overview
                    </h2>
                    <div class="prose prose-lg text-gray-700 leading-relaxed">
                        {!! $course->full_description ?? $course->description !!}
                    </div>
                </div>

                <!-- What You'll Learn -->
                @if($course->learningPoints && $course->learningPoints->count() > 0)
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
                    <h2 class="text-2xl font-semibold text-fashion-gray mb-6 flex items-center">
                        <i class="fas fa-graduation-cap text-fashion-pink mr-3"></i>
                        What You'll Learn
                    </h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($course->learningPoints as $point)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-fashion-pink to-fashion-dark rounded-full flex items-center justify-center mt-1">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <p class="text-gray-700">{{ $point->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Course Details -->
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
                    <h2 class="text-2xl font-semibold text-fashion-gray mb-6 flex items-center">
                        <i class="fas fa-info-circle text-fashion-pink mr-3"></i>
                        Course Details
                    </h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Duration</span>
                                <span class="text-fashion-gray">{{ $course->duration ?? 'Self-paced' }} hours</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Level</span>
                                <span class="text-fashion-gray capitalize">{{ $course->level ?? 'All Levels' }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Language</span>
                                <span class="text-fashion-gray">{{ $course->language ?? 'English' }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Lessons</span>
                                <span class="text-fashion-gray">{{ $course->lessons_count ?? 'Multiple' }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Last Updated</span>
                                <span class="text-fashion-gray">{{ $course->updated_at->format('M Y') }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Access</span>
                                <span class="text-fashion-gray">Lifetime</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Enrollment Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
                        <!-- Price -->
                        <div class="text-center mb-8">
                            <div class="text-4xl font-bold text-fashion-gray mb-2">
                                ${{ number_format($course->price, 2) }}
                            </div>
                            <p class="text-gray-600">One-time payment</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-4 mb-8">
                            <a href="{{ route('courses.enrollments.create', $course->id) }}" 
                               class="w-full bg-gradient-to-r from-fashion-pink to-fashion-dark text-white font-semibold py-4 px-6 rounded-2xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 text-center block">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                Enroll Now
                            </a>
                            
                            @if($course->preview_url)
                            <a href="{{ $course->preview_url }}" 
                               class="w-full border-2 border-fashion-gray text-fashion-gray font-semibold py-4 px-6 rounded-2xl hover:bg-fashion-gray hover:text-white transition-all duration-300 text-center block">
                                <i class="fas fa-play mr-2"></i>
                                Free Preview
                            </a>
                            @endif
                        </div>

                        <!-- Course Features -->
                        <div class="space-y-4">
                            <h3 class="font-semibold text-fashion-gray mb-4">This course includes:</h3>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-clock text-fashion-pink w-5"></i>
                                    <span class="text-gray-700">{{ $course->duration ?? 'Self-paced' }} hours of content</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-video text-fashion-pink w-5"></i>
                                    <span class="text-gray-700">HD video lessons</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-infinity text-fashion-pink w-5"></i>
                                    <span class="text-gray-700">Lifetime access</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-certificate text-fashion-pink w-5"></i>
                                    <span class="text-gray-700">Certificate of completion</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-mobile-alt text-fashion-pink w-5"></i>
                                    <span class="text-gray-700">Mobile & desktop access</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-comments text-fashion-pink w-5"></i>
                                    <span class="text-gray-700">Community support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Courses -->
        @if($relatedCourses->count() > 0)
        <div class="mt-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-light text-fashion-gray mb-4">Related Courses</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Discover more courses in {{ $course->category->name }}</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedCourses as $relatedCourse)
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/20 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                    <img src="{{ $relatedCourse->image ?? 'https://via.placeholder.com/350x200' }}" 
                         alt="{{ $relatedCourse->title }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-fashion-gray mb-3 line-clamp-2">
                            {{ $relatedCourse->title }}
                        </h3>
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit($relatedCourse->description, 120) }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-fashion-gray">
                                ${{ number_format($relatedCourse->price, 2) }}
                            </span>
                            <a href="{{ route('courses.show', $relatedCourse) }}" 
                               class="bg-gradient-to-r from-fashion-pink to-fashion-dark text-white px-6 py-2 rounded-full text-sm font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                View Course
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-fashion-gray to-slate-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <p class="text-lg">&copy; {{ date('Y') }} Fashion Design Platform. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>