<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Details - Creative Fashion Platform</title>
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
    }
    
    .btn {
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
    
    .btn:hover {
      background-color: #333;
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
    
    .course-reviews {
      margin-bottom: 50px;
    }
    
    .review {
      background: white;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }
    
    .review-header {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .review-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
    }
    
    .review-user {
      font-size: 16px;
      font-weight: 500;
      margin: 0;
    }
    
    .review-date {
      font-size: 14px;
      color: #999;
      margin: 3px 0 0;
    }
    
    .review-rating {
      margin-left: auto;
      color: #ffc107;
    }
    
    .review-content {
      font-size: 16px;
      line-height: 1.7;
    }
    
    .course-registration {
      background: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
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
    }
    
    .success-message {
      display: none;
      background-color: #4CAF50;
      color: white;
      padding: 20px;
      text-align: center;
      border-radius: 8px;
      margin-bottom: 20px;
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



@section('content')
<div class="container mx-auto p-4">
    <!-- عنوان الدورة -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold mb-2">{{ $course->title }}</h1>
        <p class="text-gray-600">{{ $course->short_description }}</p>
    </div>

    <!-- صورة الدورة -->
    @if($course->image)
        <img src="{{ asset('storage/' . $course->image) }}" alt="{{ $course->title }}" class="w-full h-auto rounded mb-6">
    @endif

    <!-- تفاصيل الدورة -->
    <div class="prose max-w-full mb-8">
        {!! $course->description !!}
    </div>

    <!-- الوحدات الدراسية -->
    <div>
        <h2 class="text-2xl font-semibold mb-4">الوحدات الدراسية</h2>
        <div id="modules">
            @foreach($course->modules as $index => $module)
                <div class="mb-4 border border-gray-200 rounded">
                    <button 
                        class="w-full text-right px-4 py-3 bg-gray-100 font-semibold toggle-module"
                        data-target="module-{{ $index }}">
                        {{ $module->title }}
                    </button>
                    <div id="module-{{ $index }}" class="hidden px-4 py-2 bg-white">
                        <ul class="list-disc pl-5">
                            @foreach($module->lessons as $lesson)
                                <li class="py-1 text-gray-700">{{ $lesson->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-module').forEach(function(button) {
        button.addEventListener('click', function() {
            const targetId = button.getAttribute('data-target');
            const target = document.getElementById(targetId);
            target.classList.toggle('hidden');
        });
    });
});
</script>
@endpush

</body>
</html>