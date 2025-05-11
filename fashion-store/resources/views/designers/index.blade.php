<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fashion Designers - Creative Fashion Platform</title>
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
      background-color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: fixed;
      width: 100%;
      z-index: 1000;
      top: 0;
    }
    
    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 5%;
    }
    
    .logo {
      font-size: 24px;
      font-weight: 700;
      color: #000;
      text-decoration: none;
    }
    
    .logo span {
      color: #ffd1dc;
    }
    
    nav ul {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
    }
    
    nav ul li {
      margin: 0 15px;
    }
    
    nav ul li a {
      text-decoration: none;
      color: #333;
      font-size: 16px;
      transition: all 0.3s ease;
    }
    
    nav ul li a:hover {
      color: #ffd1dc;
    }
    
    .page-header {
      text-align: center;
      padding: 100px 0 50px;
    }
    
    .page-title {
      font-size: 36px;
      font-weight: 300;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
      padding-bottom: 15px;
    }
    
    .page-title:after {
      content: '';
      position: absolute;
      width: 60px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .page-description {
      max-width: 700px;
      margin: 0 auto;
      color: #666;
      font-size: 16px;
    }
    
    .filter-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
      flex-wrap: wrap;
      gap: 20px;
    }
    
    .search-box {
      position: relative;
      max-width: 400px;
      width: 100%;
    }
    
    .search-box input {
      width: 100%;
      padding: 12px 20px;
      border: 1px solid #ddd;
      border-radius: 30px;
      font-size: 14px;
      outline: none;
      transition: all 0.3s ease;
    }
    
    .search-box input:focus {
      border-color: #ffd1dc;
      box-shadow: 0 0 10px rgba(255, 209, 220, 0.2);
    }
    
    .search-box button {
      position: absolute;
      right: 5px;
      top: 5px;
      height: 75%;
      background-color: #000;
      color: white;
      border: none;
      border-radius: 30px;
      padding: 0 20px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .search-box button:hover {
      background-color: #333;
    }
    
    .filter-dropdown select {
      padding: 10px 20px;
      border: 1px solid #ddd;
      border-radius: 30px;
      font-size: 14px;
      outline: none;
      appearance: none;
      background: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>") no-repeat;
      background-position: right 10px center;
      background-color: white;
      padding-right: 30px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .filter-dropdown select:focus {
      border-color: #ffd1dc;
      box-shadow: 0 0 10px rgba(255, 209, 220, 0.2);
    }
    
    .designers-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 30px;
      margin-bottom: 60px;
    }
    
    .designer-card {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .designer-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .designer-image {
      width: 100%;
      height: 300px;
      overflow: hidden;
      position: relative;
    }
    
    .designer-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .designer-card:hover .designer-image img {
      transform: scale(1.05);
    }
    
    .designer-info {
      padding: 20px;
      text-align: center;
    }
    
    .designer-name {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 5px;
    }
    
    .designer-specialty {
      color: #666;
      margin-bottom: 15px;
      font-size: 14px;
    }
    
    .designer-stats {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 15px;
    }
    
    .designer-stat {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    
    .stat-count {
      font-size: 18px;
      font-weight: 500;
    }
    
    .stat-label {
      font-size: 12px;
      color: #999;
    }
    
    .designer-social {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 15px;
    }
    
    .designer-social a {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background-color: #f5f5f5;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }
    
    .designer-social a:hover {
      background-color: #000;
      color: white;
    }
    
    .view-profile {
      display: inline-block;
      background-color: #000;
      color: white;
      padding: 10px 25px;
      border-radius: 30px;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    
    .view-profile:hover {
      background-color: #333;
      transform: translateY(-3px);
    }
    
    .featured-badge {
      position: absolute;
      top: 10px;
      right: 10px;
      background-color: #ffd1dc;
      color: #333;
      padding: 5px 15px;
      border-radius: 30px;
      font-size: 12px;
      font-weight: 500;
    }
    
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 40px;
    }
    
    .pagination-list {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .pagination-item {
      margin: 0 5px;
    }
    
    .pagination-link {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      color: #333;
      text-decoration: none;
      transition: all 0.3s ease;
      border: 1px solid #ddd;
    }
    
    .pagination-link:hover,
    .pagination-link.active {
      background-color: #000;
      color: white;
      border-color: #000;
    }
    
    .pagination-prev,
    .pagination-next {
      font-size: 20px;
    }
    
    .join-cta {
      background-color: #f0f0f0;
      border-radius: 8px;
      padding: 50px;
      text-align: center;
      margin-top: 60px;
    }
    
    .join-cta h2 {
      font-size: 28px;
      font-weight: 500;
      margin-bottom: 20px;
    }
    
    .join-cta p {
      color: #666;
      max-width: 700px;
      margin: 0 auto 30px;
    }
    
    .cta-button {
      display: inline-block;
      background-color: #000;
      color: white;
      padding: 15px 40px;
      border-radius: 30px;
      text-decoration: none;
      font-size: 16px;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .cta-button:hover {
      background-color: #333;
      transform: translateY(-3px);
    }
    
    footer {
      background-color: #000;
      color: white;
      padding: 60px 0 20px;
      margin-top: 100px;
    }
    
    .footer-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 40px;
      margin-bottom: 40px;
    }
    
    .footer-column {
      flex: 1;
      min-width: 240px;
    }
    
    .footer-logo {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 20px;
      display: inline-block;
    }
    
    .footer-logo span {
      color: #ffd1dc;
    }
    
    .footer-desc {
      color: #ccc;
      margin-bottom: 20px;
      line-height: 1.8;
    }
    
    .footer-social {
      display: flex;
      gap: 15px;
    }
    
    .footer-social a {
      color: white;
      font-size: 18px;
      transition: color 0.3s ease;
    }
    
    .footer-social a:hover {
      color: #ffd1dc;
    }
    
    .footer-title {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .footer-title:after {
      content: '';
      position: absolute;
      width: 40px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      left: 0;
    }
    
    .footer-links {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .footer-links li {
      margin-bottom: 10px;
    }
    
    .footer-links a {
      color: #ccc;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    
    .footer-links a:hover {
      color: #ffd1dc;
    }
    
    .footer-contact-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 15px;
      color: #ccc;
    }
    
    .footer-contact-icon {
      margin-right: 15px;
      color: #ffd1dc;
    }
    
    .footer-bottom {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid #333;
      color: #ccc;
      font-size: 14px;
    }
    
    @media (max-width: 768px) {
      .page-title {
        font-size: 28px;
      }
      
      .filter-section {
        flex-direction: column;
        align-items: stretch;
      }
      
      .search-box {
        max-width: 100%;
      }
      
      .designers-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      }
    }
    
    @media (max-width: 576px) {
      .designers-grid {
        grid-template-columns: 1fr;
      }
      
      .join-cta {
        padding: 30px 20px;
      }
      
      .join-cta h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="header-content">
      <a href="/" class="logo">Ele<span>gance</span></a>
      <nav>
        <ul>
          <li><a href="/">Home</a></li>
          <li><a href="/products">Products</a></li>
          <li><a href="/designers">Designers</a></li>
          <li><a href="/courses">Courses</a></li>
          <li><a href="/about">About</a></li>
          <li><a href="/contact">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  
  <div class="container">
    <!-- Page Header -->
    <div class="page-header">
      <h1 class="page-title">Our Fashion Designers</h1>
      <p class="page-description">Discover talented designers from around the world who are creating exclusive fashion pieces for our platform</p>
    </div>
    
    <!-- Filter Section -->
    <div class="filter-section">
      <div class="search-box">
        <form action="" method="GET">
          <input type="text" name="search" placeholder="Search for designers..." value="{{ request('search') }}">
          <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
      
      <div class="filter-dropdown">
        <form action="" method="GET" id="specialty-form">
          <select name="specialty" onchange="document.getElementById('specialty-form').submit()">
            <option value="">All Specialties</option>
            <option value="contemporary" {{ request('specialty') == 'contemporary' ? 'selected' : '' }}>Contemporary Fashion</option>
            <option value="classic" {{ request('specialty') == 'classic' ? 'selected' : '' }}>Classic Fashion</option>
            <option value="conservative" {{ request('specialty') == 'conservative' ? 'selected' : '' }}>Conservative Fashion</option>
            <option value="bridal" {{ request('specialty') == 'bridal' ? 'selected' : '' }}>Bridal Fashion</option>
          </select>
        </form>
      </div>
      
      <div class="filter-dropdown">
        <form action="" method="GET" id="sort-form">
          <select name="sort" onchange="document.getElementById('sort-form').submit()">
            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
            <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>Alphabetical</option>
            <option value="products" {{ request('sort') == 'products' ? 'selected' : '' }}>Most Products</option>
          </select>
        </form>
      </div>
    </div>
    
    <!-- Designers Grid -->
    <div class="designers-grid">
      @foreach($designers as $designer)
      <div class="designer-card">
        <div class="designer-image">
          <img src="{{ $designer->profile_picture ? asset('storage/' . $designer->profile_picture) : '/api/placeholder/300/300' }}" alt="{{ $designer->name }}">
          @if($designer->is_featured)
          <div class="featured-badge">Featured</div>
          @endif
        </div>
        <div class="designer-info">
          <h3 class="designer-name">{{ $designer->name }}</h3>
          <p class="designer-specialty">{{ $designer->specialty ?? 'Fashion Designer' }}</p>
          
          <div class="designer-stats">
            <div class="designer-stat">
              <span class="stat-count">{{ $designer->products->count() }}</span>
              <span class="stat-label">Products</span>
            </div>
            <div class="designer-stat">
              <span class="stat-count">{{ $designer->courses->count() }}</span>
              <span class="stat-label">Courses</span>
            </div>
            <div class="designer-stat">
              <span class="stat-count">{{ $designer->events->count() }}</span>
              <span class="stat-label">Events</span>
            </div>
          </div>
          
          <div class="designer-social">
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
          </div>
          
          <a href="{{ route('designers.show', $designer->id) }}" class="view-profile">View Profile</a>
        </div>
      </div>
      @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="pagination">
      <ul class="pagination-list">
        @if($designers->onFirstPage())
          <li class="pagination-item"><span class="pagination-link pagination-prev" style="opacity: 0.5"><i class="fas fa-chevron-left"></i></span></li>
        @else
          <li class="pagination-item"><a href="{{ $designers->previousPageUrl() }}" class="pagination-link pagination-prev"><i class="fas fa-chevron-left"></i></a></li>
        @endif
        
        @for($i = 1; $i <= $designers->lastPage(); $i++)
          <li class="pagination-item">
            <a href="{{ $designers->url($i) }}" class="pagination-link {{ $designers->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
          </li>
        @endfor
        
        @if($designers->hasMorePages())
          <li class="pagination-item"><a href="{{ $designers->nextPageUrl() }}" class="pagination-link pagination-next"><i class="fas fa-chevron-right"></i></a></li>
        @else
          <li class="pagination-item"><span class="pagination-link pagination-next" style="opacity: 0.5"><i class="fas fa-chevron-right"></i></span></li>
        @endif
      </ul>
    </div>
    
    <!-- Join CTA -->
    <div class="join-cta">
      <h2>Are You a Fashion Designer?</h2>
      <p>Join our platform to showcase your creative designs, offer custom pieces, and connect with customers from around the world.</p>
      <a href="/register" class="cta-button">Join as Designer</a>
    </div>
  </div>
  
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <a href="/" class="footer-logo">Ele<span>gance</span></a>
          <p class="footer-desc">A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.</p>
          <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
          </div>
        </div>
        
        <div class="footer-column">
          <h3 class="footer-title">Quick Links</h3>
          <ul class="footer-links">
            <li><a href="/">Home</a></li>
            <li><a href="/products">Products</a></li>
            <li><a href="/designers">Designers</a></li>
            <li><a href="/courses">Courses</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </div>
        
        <div class="footer-column">
          <h3 class="footer-title">Contact Info</h3>
          <div class="footer-contact-item">
            <div class="footer-contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div>123 Fashion Street, Amman, Jordan</div>
          </div>
          <div class="footer-contact-item">
            <div class="footer-contact-icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div>+962 77 123 4567</div>
          </div>
          <div class="footer-contact-item">
            <div class="footer-contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div>info@elegance.com</div>
          </div>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Elegance. All Rights Reserved.</p>
      </div>
    </div>
  </footer>
</body>
</html>