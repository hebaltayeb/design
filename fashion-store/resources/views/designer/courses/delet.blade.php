<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $course->title }} - Fashion Design Platform</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #333;
      line-height: 1.6;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 0;
      border-bottom: 1px solid #eee;
      margin-bottom: 30px;
    }
    
    .back-link {
      display: flex;
      align-items: center;
      color: #666;
      text-decoration: none;
      font-size: 16px;
      transition: color 0.3s ease;
    }
    
    .back-link:hover {
      color: #000;
    }
    
    .back-link i {
      margin-right: 8px;
    }
    
    .logo {
      font-size: 24px;
      font-weight: 500;
      color: #000;
      text-decoration: none;
    }
    
    .course-header {
      display: flex;
      margin-bottom: 50px;
    }
    
    .course-image {
      width: 50%;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .course-image img {
      width: 100%;
      height: auto;
      display: block;
    }
    
    .course-info {
      width: 50%;
      padding-left: 40px;
    }
    
    .course-title {
      font-size: 32px;
      font-weight: 500;
      margin: 0 0 15px;
      line-height: 1.3;
    }
    
    .course-meta {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    
    .course-price {
      font-size: 26px;
      font-weight: 500;
      margin-right: 20px;
    }
    
    .course-category {
      background-color: #f0f0f0;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 14px;
      color: #666;
    }
    
    .designer-info {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }
    
    .designer-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
      border: 2px solid #f0f0f0;
      background-color: #eee;
    }
    
    .designer-name {
      font-size: 18px;
      font-weight: 500;
      color: #333;
      margin: 0;
    }
    
    .designer-title {
      font-size: 14px;
      color: #666;
      margin: 5px 0 0;
    }
    
    .course-description {
      margin-bottom: 30px;
      line-height: 1.8;
    }
    
    .enrollment-btn {
      display: inline-block;
      background-color: #000;
      color: white;
      padding: 12px 30px;
      text-decoration: none;
      font-size: 16px;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      border-radius: 3px;
      width: 100%;
      text-align: center;
    }
    
    .enrollment-btn:hover {
      background-color: #333;
      transform: translateY(-3px);
    }
    
    .course-content {
      margin-top: 50px;
    }
    
    .section-title {
      font-size: 24px;
      font-weight: 500;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      width: 60px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      left: 0;
    }
    
    .course-modules {
      margin-bottom: 50px;
    }
    
    .module {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 15px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      transition: box-shadow 0.3s ease;
    }
    
    .module:hover {
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .module-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      cursor: pointer;
    }
    
    .module-title {
      font-size: 18px;
      font-weight: 500;
      margin: 0;
    }
    
    .module-content {
      margin-top: 15px;
      padding-top: 15px;
      border-top: 1px solid #eee;
      display: none;
    }
    
    .module.active .module-content {
      display: block;
    }
    
    .module-lessons {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .module-lesson {
      display: flex;
      align-items: center;
      padding: 10px 0;
      border-bottom: 1px solid #f5f5f5;
    }
    
    .module-lesson:last-child {
      border-bottom: none;
    }
    
    .lesson-icon {
      margin-right: 15px;
      color: #666;
      font-size: 16px;
    }
    
    .lesson-title {
      font-size: 16px;
    }
    
    .lesson-duration {
      margin-left: auto;
      font-size: 14px;
      color: #999;
    }
    
    .course-features {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
      margin-bottom: 50px;
    }
    
    .feature {
      display: flex;
      align-items: flex-start;
    }
    
    .feature-icon {
      margin-right: 15px;
      color: #000;
      font-size: 18px;
    }
    
    .feature-text {
      font-size: 16px;
    }
    
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
    }
    
    .alert-success {
      background-color: #dff0d8;
      color: #3c763d;
      border: 1px solid #d6e9c6;
    }
    
    .alert-danger {
      background-color: #f2dede;
      color: #a94442;
      border: 1px solid #ebccd1;
    }
    
    .enrollment-form {
      background: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
      margin-top: 30px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 12px;
      border: 1px solid #e0e0e0;
      border-radius: 5px;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      transition: border-color 0.3s ease;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: #333;
    }
    
    .error-message {
      color: #d9534f;
      font-size: 14px;
      margin-top: 5px;
    }
    
    footer {
      background-color: #f5f5f5;
      padding: 30px 0;
      text-align: center;
      margin-top: 50px;
    }
    
    @media (max-width: 992px) {
      .course-header {
        flex-direction: column;
      }
      
      .course-image, .course-info {
        width: 100%;
        padding-left: 0;
      }
      
      .course-info {
        margin-top: 30px;
      }
    }
    
    @media (max-width: 768px) {
      .section-title {
        font-size: 22px;
      }
      
      .course-title {
        font-size: 26px;
      }
    }
    
    @media (max-width: 480px) {
      .course-title {
        font-size: 22px;
      }
      
      .course-price {
        font-size: 22px;
      }
      
      .designer-name {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <a href="{{ route('courses.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Back to Courses
      </a>
      <a href="/" class="logo">Fashion Design</a>
    </header>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif

    <div class="course-header">
      <div class="course-image">
        @if($course->image)
          <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}">
        @else
          <img src="{{ asset('images/course-placeholder.jpg') }}" alt="{{ $course->title }}">
        @endif
      </div>
      
      <div class="course-info">
        <h1 class="course-title">{{ $course->title }}</h1>
        
        <div class="course-meta">
          <div class="course-price">${{ number_format($course->price, 2) }}</div>
          <div class="course-category">{{ $course->category->name ?? 'Uncategorized' }}</div>
        </div>
        
        <div class="designer-info">
          <img src="{{ $course->designer->avatar ?? asset('images/avatar-placeholder.jpg') }}" alt="{{ $course->designer->name ?? 'Designer' }}" class="designer-avatar">
          <div>
            <h3 class="designer-name">{{ $course->designer->name ?? 'Unknown Designer' }}</h3>
            <p class="designer-title">Fashion Designer</p>
          </div>
        </div>
        
        <div class="course-description">
          <p>{{ $course->description }}</p>
        </div>
        
        <a href="#enroll" class="enrollment-btn">Enroll Now</a>
      </div>
    </div>
    
    <div class="course-content">
      <h2 class="section-title">Course Features</h2>
      
      <div class="course-features">
        <div class="feature">
          <i class="fas fa-video feature-icon"></i>
          <div class="feature-text">HD Video Lessons</div>
        </div>
        
        <div class="feature">
          <i class="fas fa-file-alt feature-icon"></i>
          <div class="feature-text">Downloadable Resources</div>
        </div>
        
        <div class="feature">
          <i class="fas fa-certificate feature-icon"></i>
          <div class="feature-text">Certificate of Completion</div>
        </div>
        
        <div class="feature">
          <i class="fas fa-infinity feature-icon"></i>
          <div class="feature-text">Lifetime Access</div>
        </div>
      </div>
      
      <h2 class="section-title">Course Content</h2>
      
      <div class="course-modules">
        @if(isset($course->modules) && count($course->modules) > 0)
          @foreach($course->modules as $index => $module)
            <div class="module" id="module-{{ $index }}">
              <div class="module-header" onclick="toggleModule('module-{{ $index }}')">
                <h3 class="module-title">{{ $module->title }}</h3>
                <i class="fas fa-chevron-down"></i>
              </div>
              
              <div class="module-content">
                <ul class="module-lessons">
                  @foreach($module->lessons as $lesson)
                    <li class="module-lesson">
                      <i class="fas fa-play-circle lesson-icon"></i>
                      <span class="lesson-title">{{ $lesson->title }}</span>
                      <span class="lesson-duration">{{ $lesson->duration ?? '15 min' }}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endforeach
        @else
          <p>Course modules will be available soon.</p>
        @endif
      </div>
      
      <h2 class="section-title" id="enroll">Enroll in This Course</h2>
      
      <div class="enrollment-form">
        <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
          @csrf
          
          <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" required>
            @error('name')
              <div class="error-message">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email ?? '') }}" required>
            @error('email')
              <div class="error-message">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
            @error('phone')
              <div class="error-message">{{ $message }}</div>
            @enderror
          </div>
          
          <button type="submit" class="enrollment-btn">Complete Enrollment</button>
        </form>
      </div>
    </div>
  </div>
  
  <footer>
    <div class="container">
      <p>&copy; {{ date('Y') }} Fashion Design Platform. All rights reserved.</p>
    </div>
  </footer>

  <script>
    function toggleModule(moduleId) {
      const module = document.getElementById(moduleId);
      const content = module.querySelector('.module-content');
      const icon = module.querySelector('.fas');
      
      if (content.style.display === 'block') {
        content.style.display = 'none';
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
      } else {
        content.style.display = 'block';
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
      }
    }
  </script>
</body>
</html>