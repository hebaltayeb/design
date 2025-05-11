<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fashion Design Courses - Creative Fashion Platform</title>
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
    
    h1 {
      color: #000;
      font-size: 36px;
      font-weight: 300;
      text-transform: uppercase;
      letter-spacing: 3px;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }
    
    h1:after {
      content: '';
      position: absolute;
      width: 80px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .subtitle {
      font-size: 18px;
      color: #666;
      max-width: 700px;
      margin: 0 auto;
      text-align: center;
    }
    
    .courses-filters {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 30px 0;
      flex-wrap: wrap;
      gap: 15px;
    }
    
    .search-box {
      flex: 1;
      min-width: 250px;
      position: relative;
    }
    
    .search-box input {
      width: 100%;
      padding: 12px 45px 12px 20px;
      border: 1px solid #e0e0e0;
      border-radius: 5px;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
    }
    
    .search-box i {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
    }
    
    .filter-controls {
      display: flex;
      gap: 15px;
    }
    
    select {
      padding: 12px 40px 12px 25px;
      border: 1px solid #e0e0e0;
      border-radius: 5px;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      color: #333;
      cursor: pointer;
      appearance: none;
      background: #fff url('data:image/svg+xml;utf8,<svg fill="%23333" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>') no-repeat;
      background-position: calc(100% - 10px) center;
      padding-right: 40px;
    }
    
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 30px;
      margin: 50px 0;
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
      height: 200px;
      object-fit: cover;
      display: block;
    }
    
    .course-content {
      padding: 25px;
    }
    
    .designer-info {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .designer-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
      border: 2px solid #f0f0f0;
    }
    
    .designer-name {
      font-size: 16px;
      font-weight: 500;
      color: #333;
      margin: 0;
    }
    
    .designer-title {
      font-size: 14px;
      color: #666;
      margin: 5px 0 0;
    }
    
    .course-title {
      font-size: 22px;
      font-weight: 500;
      margin: 0 0 10px 0;
      line-height: 1.3;
    }
    
    .course-desc {
      font-size: 15px;
      color: #666;
      margin-bottom: 20px;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .course-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .course-price {
      font-size: 22px;
      font-weight: 500;
    }
    
    .btn {
      display: inline-block;
      background-color: #000;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      font-size: 15px;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      border-radius: 3px;
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
    
    .featured-section {
      background-color: #f2f2f2;
      padding: 50px 0;
      margin: 60px 0;
      border-radius: 8px;
    }
    
    .featured-section h2 {
      text-align: center;
      color: #000;
      font-size: 28px;
      font-weight: 400;
      margin-bottom: 40px;
      position: relative;
      padding-bottom: 15px;
    }
    
    .featured-section h2:after {
      content: '';
      position: absolute;
      width: 60px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .featured-designer {
      display: flex;
      align-items: center;
      max-width: 900px;
      margin: 0 auto;
      background: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }
    
    .featured-designer-img {
      width: 40%;
      height: 400px;
      object-fit: cover;
    }
    
    .featured-designer-content {
      width: 60%;
      padding: 40px;
    }
    
    .featured-designer-name {
      font-size: 28px;
      font-weight: 500;
      margin: 0 0 10px;
    }
    
    .featured-designer-title {
      font-size: 18px;
      color: #666;
      margin: 0 0 20px;
    }
    
    .featured-designer-desc {
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 30px;
    }
    
    .btn-group {
      display: flex;
      gap: 15px;
    }
    
    footer {
      background-color: #000;
      color: white;
      padding: 40px 0;
      text-align: center;
      font-size: 15px;
      font-weight: 300;
    }
    
    .pagination-container {
      display: flex;
      justify-content: center;
      margin-top: 50px;
    }
    
    .pagination {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .pagination li {
      margin: 0 5px;
    }
    
    .pagination a {
      display: flex;
      width: 40px;
      height: 40px;
      justify-content: center;
      align-items: center;
      border: 1px solid #e0e0e0;
      color: #333;
      text-decoration: none;
      font-size: 16px;
      transition: all 0.3s ease;
      border-radius: 5px;
    }
    
    .pagination a:hover, .pagination .active a {
      background-color: #000;
      color: white;
      border-color: #000;
    }
    
    .pagination .prev a, .pagination .next a {
      width: auto;
      padding: 0 15px;
    }
    
    @media (max-width: 992px) {
      .featured-designer {
        flex-direction: column;
      }
      
      .featured-designer-img {
        width: 100%;
        height: 300px;
      }
      
      .featured-designer-content {
        width: 100%;
        padding: 30px;
      }
    }
    
    @media (max-width: 768px) {
      h1 {
        font-size: 28px;
      }
      
      .courses-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      }
      
      .courses-filters {
        flex-direction: column;
        align-items: stretch;
      }
      
      .filter-controls {
        width: 100%;
      }
      
      select {
        flex: 1;
      }
      
      .btn-group {
        flex-direction: column;
      }
    }
    
    @media (max-width: 480px) {
      h1 {
        font-size: 24px;
      }
      
      .courses-grid {
        grid-template-columns: 1fr;
      }
      
      .course-title {
        font-size: 20px;
      }
      
      .course-price {
        font-size: 20px;
      }
      
      .featured-designer-name {
        font-size: 24px;
      }
      
      .featured-designer-title {
        font-size: 16px;
      }
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
    }
    
    .modal-content {
      background-color: white;
      border-radius: 8px;
      max-width: 500px;
      width: 100%;
      padding: 30px;
      position: relative;
      max-height: 90vh;
      overflow-y: auto;
    }
    
    .close-modal {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 24px;
      cursor: pointer;
      color: #666;
    }
    
    .modal-title {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
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
    
    .form-group textarea {
      height: 100px;
      resize: vertical;
    }
    
    .modal-footer {
      text-align: center;
      margin-top: 30px;
    }
    
    .modal-active {
      display: flex;
      animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Success Message */
    .success-message {
      display: none;
      background-color: #4CAF50;
      color: white;
      padding: 20px;
      text-align: center;
      border-radius: 8px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Fashion Design Courses</h1>
      <p class="subtitle">Explore creative courses by top designers</p>
    </header>
    <div class="courses-filters">
      <div class="search-box">
        <form action="{{ route('courses.index') }}" method="GET">
          <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search for a course..." />
          <i class="fa fa-search"></i>
        </form>
      </div>

      <div class="filter-controls">
        <form action="{{ route('courses.index') }}" method="GET">
          <select name="category">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
          </select>

          <button type="submit" class="btn">Apply Filter</button>
        </form>
      </div>
    </div>
    <div class="courses-grid">
      @foreach ($courses as $course)
        <div class="course-card">
          <img src="https://via.placeholder.com/400x200" alt="Course Image" class="course-img">
          <div class="course-content">
            <div class="designer-info">
              <img src="{{ $course->designer->profile_image ?? 'https://via.placeholder.com/50' }}" class="designer-avatar" alt="Designer">
              <div>
                <p class="designer-name">{{ $course->designer->name }}</p>
                <p class="designer-title">Fashion Designer</p>
              </div>
            </div>
            <h3 class="course-title">{{ $course->title }}</h3>
            <p class="course-desc">{{ $course->description }}</p>
            <div class="course-meta">
              <span class="course-price">${{ number_format($course->price, 2) }}</span>
              <a href="{{ route('courses.show', $course->id) }}" class="btn btn-outline">Watch</a>

            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <script>
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('courseModal');

    openModalBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeModalBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target == modal) {
            modal.style.display = 'none';
        }
    });

    // نموذج الإرسال (نموذجي)
    document.getElementById('courseForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('تم إرسال الطلب بنجاح! سيتم التواصل معك قريباً.');
        modal.style.display = 'none';
    });


    const searchInput = document.getElementById('search');
const filterSelect = document.getElementById('filter');
const courseCards = document.querySelectorAll('.course-card');

function filterCourses() {
    const keyword = searchInput.value.toLowerCase();
    const selectedFilter = filterSelect.value;

    courseCards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const category = card.getAttribute('data-category');

        const matchText = title.includes(keyword);
        const matchCategory = selectedFilter === "" || category === selectedFilter;

        if (matchText && matchCategory) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}

searchInput.addEventListener('input', filterCourses);
filterSelect.addEventListener('change', filterCourses);

</script>

</body>
</html>