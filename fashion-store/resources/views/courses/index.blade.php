<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fashion Design Courses - Creative Fashion Platform</title>
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
  
  <!-- Header -->
  <div class="bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="flex items-center justify-between">
        <a href="{{ route('landing') }}" 
           class="flex items-center space-x-2 text-fashion-gray hover:text-fashion-pink transition-colors duration-300">
          <i class="fas fa-arrow-left text-lg"></i>
          <span class="font-medium">Back to Home</span>
        </a>
        <div class="text-sm text-gray-500">
          Fashion Design Courses
        </div>
      </div>
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Page Header -->
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-light text-fashion-gray mb-6 leading-tight">
        Fashion Design <span class="font-semibold bg-gradient-to-r from-fashion-pink to-fashion-dark bg-clip-text text-transparent">Courses</span>
      </h1>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
        Learn from world-class fashion designers and take your skills to the next level with our comprehensive online courses.
      </p>
    </div>

    <!-- Filters Section -->
    <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/20 mb-8">
      <form method="GET" action="{{ route('courses.index') }}" class="space-y-4 md:space-y-0 md:flex md:items-center md:space-x-6">
        
        <!-- Search Box -->
        <div class="flex-1">
          <div class="relative">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Search courses..." 
                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          </div>
        </div>

        <!-- Category Filter -->
        <div class="md:w-48">
          <select name="category" 
                  class="w-full py-3 px-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
            <option value="">All Categories</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Designer Filter -->
        <div class="md:w-48">
          <select name="designer" 
                  class="w-full py-3 px-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
            <option value="">All Designers</option>
            @foreach($designers as $designer)
              <option value="{{ $designer->id }}" {{ request('designer') == $designer->id ? 'selected' : '' }}>
                {{ $designer->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Price Filter -->
        <div class="md:w-40">
          <select name="price" 
                  class="w-full py-3 px-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
            <option value="">Price</option>
            <option value="low" {{ request('price') == 'low' ? 'selected' : '' }}>Low to High</option>
            <option value="high" {{ request('price') == 'high' ? 'selected' : '' }}>High to Low</option>
          </select>
        </div>

        <!-- Filter Button -->
        <button type="submit" 
                class="w-full md:w-auto bg-gradient-to-r from-fashion-pink to-fashion-dark text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
          <i class="fas fa-filter mr-2"></i>
          Filter
        </button>
      </form>
    </div>

    <!-- Results Count -->
    <div class="flex items-center justify-between mb-8">
      <p class="text-gray-600">
        Showing {{ $courses->count() }} of {{ $courses->total() }} courses
      </p>
      <a href="{{ route('courses.index') }}" 
         class="text-fashion-pink hover:text-fashion-dark transition-colors duration-300">
        Clear Filters
      </a>
    </div>

    <!-- Courses Grid -->
    @if($courses->count() > 0)
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
      @foreach($courses as $course)
      <div class="bg-white/70 backdrop-blur-sm rounded-2xl overflow-hidden shadow-xl border border-white/20 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group">
        
        <!-- Course Image -->
        <div class="relative overflow-hidden">
          <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://via.placeholder.com/400x250' }}" 
               alt="{{ $course->title }}" 
               class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-300">
          
          <!-- Price Badge -->
          <div class="absolute top-4 right-4 bg-gradient-to-r from-fashion-pink to-fashion-dark text-white px-4 py-2 rounded-full font-bold">
            ${{ number_format($course->price, 2) }}
          </div>

          <!-- Category Badge -->
          <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-fashion-gray px-3 py-1 rounded-full text-sm font-medium">
          
          </div>
        </div>

        <!-- Course Content -->
        <div class="p-6">
          
          <!-- Designer Info -->
          <div class="flex items-center space-x-3 mb-4">
            <img src="{{ $course->designer->profile_image ?? 'https://via.placeholder.com/40' }}" 
                 alt="{{ $course->designer->name }}"
                 class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
            <div>
              <p class="font-medium text-fashion-gray text-sm">{{ $course->designer->name }}</p>
              <p class="text-gray-500 text-xs">Fashion Designer</p>
            </div>
          </div>

          <!-- Course Title -->
          <h3 class="text-xl font-semibold text-fashion-gray mb-3 line-clamp-2 group-hover:text-fashion-pink transition-colors duration-300">
            {{ $course->title }}
          </h3>

          <!-- Course Description -->
          <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
            {{ Str::limit($course->description, 120) }}
          </p>

          <!-- Course Meta -->
          <div class="flex items-center justify-between text-sm text-gray-500 mb-6">
            <div class="flex items-center space-x-4">
              @if($course->duration)
              <span class="flex items-center">
                <i class="fas fa-clock mr-1"></i>
                {{ $course->duration }}h
              </span>
              @endif
              
              @if($course->level)
              <span class="flex items-center">
                <i class="fas fa-signal mr-1"></i>
                {{ ucfirst($course->level) }}
              </span>
              @endif
            </div>
          </div>

          <!-- Action Button -->
          <a href="{{ route('courses.show', $course) }}" 
             class="w-full bg-gradient-to-r from-fashion-pink to-fashion-dark text-white font-semibold py-3 px-6 rounded-xl text-center block hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-eye mr-2"></i>
            View Course
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
      {{ $courses->links() }}
    </div>

    @else
    <!-- No Courses Found -->
    <div class="text-center py-16">
      <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
        <i class="fas fa-search text-4xl text-gray-400"></i>
      </div>
      <h3 class="text-2xl font-semibold text-gray-600 mb-4">No courses found</h3>
      <p class="text-gray-500 mb-6">Try adjusting your filters or search terms.</p>
      <a href="{{ route('courses.index') }}" 
         class="bg-gradient-to-r from-fashion-pink to-fashion-dark text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
        View All Courses
      </a>
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