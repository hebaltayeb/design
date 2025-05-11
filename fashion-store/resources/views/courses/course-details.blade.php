<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $course->title }} - Fashion Design Course</title>
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
      direction: ltr;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    header {
      text-align: center;
      padding: 30px 0;
    }
    
    .back-button {
      position: absolute;
      top: 30px;
      left: 30px;
      text-decoration: none;
      color: #000;
      font-size: 16px;
      display: flex;
      align-items: center;
    }
    
    .back-button i {
      margin-right: 5px;
    }
    
    .course-header {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 40px;
    }
    
    .course-title {
      font-size: 36px;
      font-weight: 500;
      text-align: center;
      margin-bottom: 15px;
    }
    
    .course-category {
      background-color: #f1f1f1;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 14px;
      margin-bottom: 20px;
    }
    
    .designer-info {
      display: flex;
      align-items: center;
      margin-bottom: 30px;
    }
    
    .designer-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
      border: 2px solid #f0f0f0;
    }
    
    .designer-name {
      font-size: 18px;
      font-weight: 500;
      color: #333;
      margin: 0;
    }
    
    .designer-title {
      font-size: 15px;
      color: #666;
      margin: 5px 0 0;
    }
    
    .course-main {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 40px;
    }
    
    .course-video-container {
      position: relative;
      width: 100%;
      height: 0;
      padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
      overflow: hidden;
      border-radius: 8px;
      margin-bottom: 30px;
    }
    
    .course-video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
    
    .course-image {
      width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 30px;
    }
    
    .course-content h2 {
      font-size: 24px;
      font-weight: 500;
      margin: 30px 0 15px;
    }
    
    .course-description {
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 30px;
    }
    
    .course-details {
      list-style: none;
      padding: 0;
      margin: 0 0 30px;
    }
    
    .course-details li {
      display: flex;
      padding: 12px 0;
      border-bottom: 1px solid #eee;
    }
    
    .detail-label {
      width: 40%;
      font-weight: 500;
    }
    
    .detail-value {
      width: 60%;
      color: #666;
    }
    
    .course-sidebar {
      background: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      height: fit-content;
    }
    
    .course-price {
      font-size: 32px;
      font-weight: 500;
      margin-bottom: 20px;
    }
    
    .btn {
      display: block;
      width: 100%;
      background-color: #000;
      color: white;
      padding: 15px;
      text-decoration: none;
      font-size: 16px;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      border-radius: 3px;
      text-align: center;
      margin-bottom: 15px;
    }
    
    .btn:hover {
      background-color: #333;
      transform: translateY(-3px);
    }
    
    .btn-outline {
      background-color: transparent;
      color: #000;
      border: 1px solid #000;
    }
    
    .btn-outline:hover {
      background-color: #000;
      color: white;
    }
    
    .course-features {
      margin-top: 30px;
    }
    
    .feature-item {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .feature-icon {
      width: 20px;
      text-align: center;
      margin-right: 10px;
      color: #000;
    }
    
    .modules-list {
      margin-top: 20px;
    }
    
    .module-item {
      background: #f8f8f8;
      border-radius: 5px;
      padding: 15px 20px;
      margin-bottom: 15px;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .module-item:hover {
      background: #f1f1f1;
    }
    
    .module-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .module-title {
      font-weight: 500;
      margin: 0;
    }
    
    .module-icon {
      transition: transform 0.3s ease;
    }
    
    .module-content {
      padding-top: 15px;
      display: none;
      border-top: 1px solid #e5e5e5;
      margin-top: 15px;
    }
    
    .lesson-item {
      display: flex;
      align-items: center;
      padding: 10px 0;
    }
    
    .lesson-icon {
      margin-right: 10px;
      color: #666;
    }
    
    .lesson-title {
      margin: 0;
      font-size: 15px;
    }
    
    .lesson-duration {
      margin-left: auto;
      font-size: 14px;
      color: #666;
    }
    
    .active .module-icon {
      transform: rotate(180deg);
    }
    
    .active .module-content {
      display: block;
    }
    
    .related-courses {
      margin-top: 60px;
    }
    
    .related-courses h2 {
      text-align: center;
      font-size: 28px;
      margin-bottom: 30px;
    }
    
    .related-courses-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }
    
    .course-card {
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .course-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }
    
    .course-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      display: block;
    }
    
    .related-course-content {
      padding: 20px;
    }
    
    .related-course-title {
      font-size: 18px;
      font-weight: 500;
      margin: 0 0 10px 0;
      line-height: 1.3;
    }
    
    .related-course-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .related-course-price {
      font-size: 18px;
      font-weight: 500;
    }
    
    @media (max-width: 992px) {
      .course-main {
        grid-template-columns: 1fr;
      }
      
      .related-courses-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
    
    @media (max-width: 768px) {
      .related-courses-grid {
        grid-template-columns: 1fr;
      }
      
      .course-title {
        font-size: 28px;
      }
    }
    
    footer {
      background-color: #000;
      color: white;
      padding: 40px 0;
      text-align: center;
      font-size: 15px;
      font-weight: 300;
      margin-top: 80px;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ route('courses.index') }}" class="back-button">
      <i class="fas fa-arrow-left"></i> Back to Courses
    </a>
    
    <div class="course-header">
      <h1 class="course-title">{{ $course->title }}</h1>
      <span class="course-category">{{ $course->category->name }}</span>
      
      <div class="designer-info">
        <img src="{{ $course->designer->profile_image ?? 'https://via.placeholder.com/60' }}" class="designer-avatar" alt="{{ $course->designer->name }}">
        <div>
          <p class="designer-name">{{ $course->designer->name }}</p>
          <p class="designer-title">Fashion Designer</p>
        </div>
      </div>
    </div>
    
    <div class="course-main">
      <div class="course-content">
        @if($course->video_url)
          <div class="course-video-container">
            <iframe 
              class="course-video" 
              src="{{ $course->video_url }}" 
              title="{{ $course->title }}" 
              frameborder="0" 
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
              allowfullscreen>
            </iframe>
          </div>
        @else
          <img src="{{ $course->image ?? 'https://via.placeholder.com/800x450' }}" alt="{{ $course->title }}" class="course-image">
        @endif
        
        <h2>Course Description</h2>
        <div class="course-description">
          {!! $course->full_description !!}
        </div>
        @if($course->learningPoints && $course->learningPoints->count() > 0)
  @foreach($course->learningPoints as $point)
    <li>{{ $point->description }}</li>
  @endforeach
@else
  <li>No learning points available.</li>
@endif

        <h2>What You'll Learn</h2>
        <ul>
          @foreach($course->learningPoints as $point)
            <li>{{ $point->description }}</li>
          @endforeach
        </ul>
        
      </div>
      
      <div class="course-sidebar">
        <div class="course-price">${{ number_format($course->price, 2) }}</div>
        
        <a href="{{ route('courses.enrollments.create', $course->id) }}" class="btn btn-primary">Enroll Now</a>
    
        <a href="{{ $course->preview_url ?? '#' }}" class="btn btn-outline">Free Preview</a>
        
        <div class="course-features">
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-clock"></i></div>
            <div class="feature-text">{{ $course->duration }} total hours</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-film"></i></div>
            <div class="feature-text">{{ $course->lessons_count }} lessons</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-infinity"></i></div>
            <div class="feature-text">Full lifetime access</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-certificate"></i></div>
            <div class="feature-text">Certificate of completion</div>
          </div>
          <div class="feature-item">
            <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
            <div class="feature-text">Access on mobile and TV</div>
          </div>
        </div>
        
        <ul class="course-details">
          <li>
            <span class="detail-label">Last Updated</span>
            <span class="detail-value">{{ $course->updated_at->format('F Y') }}</span>
          </li>
          <li>
            <span class="detail-label">Language</span>
            <span class="detail-value">{{ $course->language }}</span>
          </li>
          <li>
            <span class="detail-label">Skill Level</span>
            <span class="detail-value">{{ $course->level }}</span>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="related-courses">
      <h2>Related Courses</h2>
      <div class="related-courses-grid">
        @foreach($relatedCourses as $relatedCourse)
          <div class="course-card">
            <img src="{{ $relatedCourse->image ?? 'https://via.placeholder.com/350x180' }}" alt="{{ $relatedCourse->title }}" class="course-img">
            <div class="related-course-content">
              <h3 class="related-course-title">{{ $relatedCourse->title }}</h3>
              <div class="related-course-meta">
                <span class="related-course-price">${{ number_format($relatedCourse->price, 2) }}</span>
                <a href="{{ route('courses.show', $relatedCourse) }}" class="btn btn-outline">View Course</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  
  <footer>
    <p>&copy; {{ date('Y') }} Fashion Design Courses Platform. All Rights Reserved.</p>
  </footer>
  
  <script>
    // Toggle course modules
    document.querySelectorAll('.module-item').forEach(module => {
      module.addEventListener('click', function() {
        this.classList.toggle('active');
      });
    });
  </script>
</body>
</html>