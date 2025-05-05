
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Elegance') }} - Fashion Design Platform</title>
  <link href="https://fonts.googleapis.com/css2?family={{ app()->getLocale() == 'ar' ? 'Tajawal' : 'Poppins' }}:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
   
    
    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
    }
    
    /* Header Styles */
    header {
      position: fixed;
      width: 100%;
      z-index: 1000;
      background-color: rgba(255, 255, 255, 0.95);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    header.scrolled {
      background-color: #fff;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    
    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 0;
    }
    
    .logo {
      font-size: 28px;
      font-weight: 300;
      color: #000;
      text-decoration: none;
      letter-spacing: 1px;
    }
    
    .logo span {
      font-weight: 700;
      color: #ffd1dc;
    }
    
    nav ul {
      display: flex;
      list-style: none;
    }
    
    nav ul li {
      margin: 0 12px;
    }
    
    nav ul li a {
      text-decoration: none;
      color: #333;
      font-size: 16px;
      transition: color 0.3s ease;
      position: relative;
    }
    
    nav ul li a:hover {
      color: #ffd1dc;
    }
    
    nav ul li a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      background-color: #ffd1dc;
      bottom: -5px;
    }
    
    nav ul li a:hover::after {
      width: 100%;
    }
    
    .cta-buttons {
      display: flex;
      gap: 15px;
    }
    
    .btn {
      padding: 10px 20px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-outline {
      border: 1px solid #000;
      color: #000;
    }
    
    .btn-outline:hover {
      background-color: #000;
      color: #fff;
    }
    
    .btn-primary {
      background-color: #000;
      color: #fff;
      border: 1px solid #000;
    }
    
    .btn-primary:hover {
      background-color: transparent;
      color: #000;
    }
    
    .btn-secondary {
      background-color: #ffd1dc;
      color: #333;
      border: 1px solid #ffd1dc;
    }
    
    .btn-secondary:hover {
      background-color: transparent;
      color: #ffd1dc;
    }
    
    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #333;
    }
    
    /* Hero Section */
    .hero {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: center;
      background-color: #f9f9f9;
      overflow: hidden;
    }
    
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 600px;
    }
    
    .hero h1 {
      font-size: 48px;
      font-weight: 300;
      margin-bottom: 20px;
      line-height: 1.2;
    }
    
    .hero h1 strong {
      font-weight: 700;
      color: #ffd1dc;
    }
    
    .hero p {
      font-size: 18px;
      color: #666;
      margin-bottom: 30px;
    }
    
    .hero-cta {
      display: flex;
      gap: 20px;
    }
    
    .hero-image {
      position: absolute;
     
    }
    
    .hero-image img {
      position: absolute;
      top: 0;
      
    }
    
    .hero-image::before {
      content: '';
      position: absolute;
      top: 0;
      
    }
    
    /* Features Section */
    .features {
      padding: 100px 0;
      background-color: #fff;
    }
    
    .section-header {
      text-align: center;
      margin-bottom: 60px;
    }
    
    .section-header h2 {
      font-size: 36px;
      font-weight: 300;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
      padding-bottom: 15px;
    }
    
    .section-header h2::after {
      content: '';
      position: absolute;
      width: 60px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .section-header p {
      font-size: 18px;
      color: #666;
      max-width: 700px;
      margin: 0 auto;
    }
    
    .features-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 30px;
    }
    
    .feature-card {
      background-color: #f9f9f9;
      border-radius: 8px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
    }
    
    .feature-icon {
      font-size: 48px;
      color: #ffd1dc;
      margin-bottom: 20px;
    }
    
    .feature-card h3 {
      font-size: 22px;
      font-weight: 500;
      margin-bottom: 15px;
    }
    
    .feature-card p {
      font-size: 16px;
      color: #666;
    }
    
    /* Designers Section */
    .designers {
      padding: 100px 0;
      background-color: #f9f9f9;
    }
    
    .designers-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
    }
    
    .designer-card {
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }
    
    .designer-card:hover {
      transform: translateY(-10px);
    }
    
    .designer-image {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }
    
    .designer-info {
      padding: 20px;
      text-align: center;
    }
    
    .designer-info h3 {
      font-size: 22px;
      font-weight: 500;
      margin-bottom: 5px;
    }
    
    .designer-info span {
      font-size: 16px;
      color: #666;
      display: block;
      margin-bottom: 15px;
    }
    
    .designer-social {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 15px;
    }
    
    .designer-social a {
      color: #666;
      font-size: 18px;
      transition: color 0.3s ease;
    }
    
    .designer-social a:hover {
      color: #ffd1dc;
    }
    
    .designer-action {
      display: inline-block;
      border-bottom: 1px solid #ffd1dc;
      padding-bottom: 2px;
      color: #333;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    
    .designer-action:hover {
      color: #ffd1dc;
    }
    
    /* Courses Section */
    .courses {
      padding: 100px 0;
      background-color: #fff;
    }
    
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }
    
    .course-card {
      background-color: #f9f9f9;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }
    
    .course-card:hover {
      transform: translateY(-10px);
    }
    
    .course-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }
    
    .course-info {
      padding: 20px;
    }
    
    .course-category {
      display: inline-block;
      padding: 5px 10px;
      background-color: #ffd1dc;
      color: #333;
      border-radius: 4px;
      font-size: 12px;
      margin-bottom: 10px;
    }
    
    .course-title {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 10px;
    }
    
    .course-instructor {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .instructor-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
     
    }
    
    .instructor-name {
      font-size: 14px;
      color: #666;
    }
    
    .course-meta {
      display: flex;
      justify-content: space-between;
      border-top: 1px solid #eee;
      padding-top: 15px;
    }
    
    .course-price {
      font-weight: 700;
    }
    
    .course-action {
      color: #ffd1dc;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    
    .course-action:hover {
      color: #ff9aad;
    }
    
    /* Products Section */
    .products {
      padding: 100px 0;
      background-color: #f9f9f9;
    }
    
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
    }
    
    .product-card {
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease;
    }
    
    .product-card:hover {
      transform: translateY(-10px);
    }
    
    .product-image {
      position: relative;
      width: 100%;
      height: 280px;
      overflow: hidden;
    }
    
    .product-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image img {
      transform: scale(1.05);
    }
    
    .product-actions {
      position: absolute;
      bottom: 15px;
      right: 15px;
      display: flex;
      gap: 10px;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.3s ease;
    }
    
    .product-card:hover .product-actions {
      opacity: 1;
      transform: translateY(0);
    }
    
    .product-actions a, 
    .product-actions button {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #fff;
      color: #333;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
    }
    
    .product-actions a:hover,
    .product-actions button:hover {
      background-color: #ffd1dc;
      color: #333;
    }
    
    .product-info {
      padding: 20px;
    }
    
    .product-name {
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 5px;
    }
    
    .product-designer {
      font-size: 14px;
      color: #666;
      margin-bottom: 10px;
    }
    
    .product-price {
      font-weight: 700;
    }
    
    .original-price {
      text-decoration: line-through;
      color: #999;
      margin-right: 8px;
      font-weight: normal;
    }
    
    .discount-price {
      color: #ff5b79;
    }
    
    .view-all-btn {
      display: flex;
      justify-content: center;
      margin-top: 50px;
    }
    
    /* Testimonials Section */
    .testimonials {
      padding: 100px 0;
      background-color: #fff;
    }
    
    .testimonials-wrapper {
      max-width: 800px;
      margin: 0 auto;
      position: relative;
    }
    
    .testimonial-item {
      background-color: #f9f9f9;
      border-radius: 8px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .testimonial-content {
      font-size: 18px;
      color: #666;
      margin-bottom: 20px;
      position: relative;
    }
    
    .testimonial-content::before,
    .testimonial-content::after {
      content: '"';
      font-size: 30px;
      color: #ffd1dc;
      position: absolute;
    }
    
    
    
   
    .testimonial-author {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
   
    .author-info h4 {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 5px;
    }
    
    .author-info span {
      font-size: 14px;
      color: #666;
    }
    
    /* CTA Section */
   
    
    .cta h2 {
      font-size: 36px;
      font-weight: 300;
      margin-bottom: 20px;
      color: #333;
    }
    
    .cta p {
      font-size: 18px;
      color: #666;
      max-width: 600px;
      margin: 0 auto 30px;
    }
    
    /* Footer */
    footer {
      background-color: #000;
      color: #fff;
      padding: 60px 0 20px;
    }
    
    .footer-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-bottom: 40px;
    }
    
    .footer-column {
      flex: 1;
      min-width: 200px;
      margin-bottom: 30px;
    }
    
    .footer-column h3 {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 20px;
      position: relative;
      padding-bottom: 10px;
    }
    
    
    .footer-column p {
      font-size: 14px;
      color: #ccc;
      margin-bottom: 20px;
    }
    
    .footer-links {
      list-style: none;
    }
    
    .footer-links li {
      margin-bottom: 10px;
    }
    
    .footer-links li a {
      color: #ccc;
      text-decoration: none;
      font-size: 14px;
      transition: color 0.3s ease;
    }
    
    .footer-links li a:hover {
      color: #ffd1dc;
    }
    
    .social-links {
      display: flex;
      gap: 15px;
    }
    
    .social-links a {
      color: #fff;
      font-size: 18px;
      transition: color 0.3s ease;
    }
    
    .social-links a:hover {
      color: #ffd1dc;
    }
    
   
    
   
    
    .newsletter button:hover {
      background-color: #ff9aad;
    }
    
    .footer-bottom {
      text-align: center;
      padding-top: 20px;
      border-top: 1px solid #333;
      font-size: 14px;
      color: #ccc;
    }
    
    /* Responsive Styles */
    @media (max-width: 992px) {
      .features-grid {
        grid-template-columns: repeat(2, 1fr);
      }
      
      .hero h1 {
        font-size: 40px;
      }
      
      
    }
    
    @media (max-width: 768px) {
      nav ul {
        display: none;
      }
      
      .mobile-menu-btn {
        display: block;
      }
      
      .hero-content {
        text-align: center;
        margin: 0 auto;
      }
      
      .hero-cta {
        justify-content: center;
      }
      
      .hero-image {
        opacity: 0.3;
      }
      
      
    @media (max-width: 576px) {
      .header-content {
        padding: 10px 0;
      }
      
      .cta-buttons {
        display: none;
      }
      
      .logo {
        font-size: 24px;
      }
      
      .hero h1 {
        font-size: 32px;
      }
      
      .hero p {
        font-size: 16px;
      }
      
      .section-header h2 {
        font-size: 28px;
      }
      
      .section-header p {
        font-size: 16px;
      }
    }
  </style>
</head>
<b>
  <!-- Header -->
  <header>
    <div class="container">
      <div class="header-content">
        <a href="{{ route('landing') }}" class="logo">Ele<span>gance</span></a>
        <nav>
          <ul>
            <li><a href="#hero">{{ __('Home') }}</a></li>
           
            <li><a href="#designers">{{ __('Designers') }}</a></li>
            <li><a href="#products">{{ __('Products') }}</a></li>
            <li><a href="#courses">{{ __('Courses') }}</a></li>
            <li><a href="#contact">{{ __('Contact') }}</a></li>
            <li><a href="#contact">{{ __('About') }}</a></li>
            <li><a href="#contact">{{ __('Blog') }}</a></li>
          </ul>
        </nav>
        <div class="cta-buttons">
          @auth
            <a href="{{ route('dashboard') }}" class="btn btn-outline">{{ __('Dashboard') }}</a>
          @else
            <a href="{{ route('login') }}" class="btn btn-outline">{{ __('Sign In') }}</a>
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Create Account') }}</a>
          @endauth
        </div>
        <button class="mobile-menu-btn">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="hero" id="hero">
    <div class="container">
      <div class="hero-content">
        <h1>{{ __('Your Creative Space for Exceptional') }} <strong>{{ __('Fashion') }}</strong></h1>
        <p>{{ __('A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.') }}</p>
        <div class="hero-cta">
          <a href="#products" class="btn btn-primary">{{ __('Shop Now') }}</a>
          <a href="#designers" class="btn btn-secondary">{{ __('Explore Designers') }}</a>
        </div>
      </div>
    </div>
    <div class="hero-image">
      <img src="{{ asset('img/hero-image.jpg') }}" alt="{{ __('Fashion showcase') }}">
    </div>
  </section>

  <!-- Features Section -->
  <section class="features" id="features">
    <div class="container">
      <div class="section-header">
        <h2>{{ __('Why Choose Us?') }}</h2>
        <p>{{ __('We offer a unique experience combining creativity, elegance, and privacy') }}</p>
      </div>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-tshirt"></i>
          </div>
          <h3>{{ __('Exclusive Designs') }}</h3>
          <p>{{ __('Unique designs from professional designers that match your taste and personality.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-sliders-h"></i>
          </div>
          <h3>{{ __('Size Customization') }}</h3>
          <p>{{ __('Size customization options (S, M, L, XL) to fit all body types.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-graduation-cap"></i>
          </div>
          <h3>{{ __('Educational Courses') }}</h3>
          <p>{{ __('Outstanding educational content through fashion design courses.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-calendar-alt"></i>
          </div>
          <h3>{{ __('Exclusive Fashion Shows') }}</h3>
          <p>{{ __('Exclusive fashion shows for designers to showcase their latest creations.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <h3>{{ __('Seamless Shopping') }}</h3>
          <p>{{ __('Easy and smooth shopping experience with multiple payment options.') }}</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-filter"></i>
          </div>
          <h3>{{ __('Product Filtering') }}</h3>
          <p>{{ __('Filter products by price, color, and bestsellers.') }}</p>
        </div>
      </div>
    </div>
  </section>
  



  <!-- Designers Section -->
  <section class="designers" id="designers">
    <div class="container">
      <div class="section-header">
        <h2>Featured Designers</h2>
        <p>Meet our elite fashion designers in the fashion world</p>
      </div>
      <div class="designers-grid">
        @foreach($designers as $designer)
        <div class="designer-card">
          <img src="{{ $designer->profile_picture ? asset('storage/'.$designer->profile_picture) : '/api/placeholder/400/300' }}" 
               alt="{{ $designer->name }}" class="designer-image">
          <div class="designer-info">
            <h3>{{ $designer->name }}</h3>
            <span>{{ $designer->bio ? \Illuminate\Support\Str::limit($designer->bio, 30) : 'Fashion Designer' }}</span>
            <div class="designer-social">
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
            <a href="{{ route('products.index', ['designer' => $designer->id]) }}" class="designer-action">View Designs</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Products Section -->
  <section class="products" id="products">
    <div class="container">
      <div class="section-header">
        <h2>Top Products</h2>
        <p>Explore our best-selling exclusive designs</p>
      </div>
      <div class="products-grid">
        @foreach($topProducts as $product)
        <div class="product-card">
          <div class="product-image">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/300/280' }}" alt="{{ $product->name }}">
            <div class="product-actions">
              <a href="{{ route('products.show', $product->id) }}"><i class="fas fa-eye"></i></a>
              <form action="{{ route('cart.add') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" value="M">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" style="background:none;border:none;cursor:pointer;">
                  <i class="fas fa-shopping-cart"></i>
                </button>
              </form>
              @auth
              <form action="{{ route('favorites.toggle') }}" method="POST" style="display:inline;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" style="background:none;border:none;cursor:pointer;">
                  <i class="fas fa-heart {{ auth()->user()->hasFavorited($product->id) ? 'text-danger' : '' }}"></i>
                </button>
              </form>
              @else
              <a href="{{ route('login') }}"><i class="fas fa-heart"></i></a>
              @endauth
            </div>
          </div>
          <div class="product-info">
            <h3 class="product-name">{{ $product->name }}</h3>
            <p class="product-designer">Design by: {{ $product->designer->name }}</p>
            <span class="product-price">
              @if($product->hasDiscount())
                <span style="text-decoration:line-through;color:#999;">${{ number_format($product->price, 2) }}</span>
                ${{ number_format($product->discounted_price, 2) }}
              @else
                ${{ number_format($product->price, 2) }}
              @endif
            </span>
          </div>
        </div>
        @endforeach
      </div>
      <div class="view-all-btn">
        <a href="{{ route('products.index') }}" class="btn btn-outline">View All Products</a>
      </div>
    </div>
  </section>
  