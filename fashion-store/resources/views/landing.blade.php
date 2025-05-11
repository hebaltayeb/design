<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Elegance') }} - Fashion Design Platform</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: '{{ app()->getLocale() == 'ar' ? 'Tajawal' : 'Poppins' }}', sans-serif;
    }
    
    body {
      background-color: #f9f9f9;
      color: #333;
      line-height: 1.6;
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
      left: 0;
      transition: width 0.3s ease;
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
    
    /* Header Icons */
    .header-icons {
      display: flex;
      gap: 15px;
      align-items: center;
    }
    
    .icon-btn {
      color: #333;
      font-size: 20px;
      position: relative;
      transition: color 0.3s ease;
      margin: 0 10px;
      text-decoration: none;
    }
    
    .icon-btn:hover {
      color: #ffd1dc;
    }
    
    .counter {
      position: absolute;
      top: -8px;
      right: -8px;
      background-color: #ffd1dc;
      color: #333;
      font-size: 12px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 500;
    }
    
    /* Hero Slider Styles */
    .hero-slider {
      position: relative;
      height: 100vh;
      overflow: hidden;
      padding-top: 80px;
    }
    
    .slide {
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.8s ease, visibility 0.8s ease;
    }
    
    .slide.active {
      opacity: 1;
      visibility: visible;
      z-index: 1;
    }
    
    .slide .hero-content {
      position: relative;
      z-index: 2;
      max-width: 600px;
    }
    
    .slide .hero-image {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 50%;
      height: 100%;
      z-index: 1;
    }
    
    .slide .hero-image img {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
      height: 80%;
      width: auto;
      object-fit: cover;
    }
    
    .slide .hero-image::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to right, #f9f9f9 0%, rgba(249, 249, 249, 0) 100%);
      z-index: 1;
    }
    
    /* Slider Navigation */
    .slider-dots {
      position: absolute;
      bottom: 30px;
      left: 0;
      right: 0;
      display: flex;
      justify-content: center;
      gap: 12px;
      z-index: 10;
    }
    
    .dot {
      width: 12px;
      height: 12px;
      background-color: rgba(0, 0, 0, 0.2);
      border-radius: 50%;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .dot.active {
      background-color: #ffd1dc;
      transform: scale(1.2);
    }
    
    .slider-arrows {
      position: absolute;
      top: 50%;
      width: 100%;
      display: flex;
      justify-content: space-between;
      padding: 0 30px;
      z-index: 10;
      transform: translateY(-50%);
    }
    
    .arrow {
      width: 50px;
      height: 50px;
      border: none;
      background-color: rgba(255, 255, 255, 0.8);
      color: #333;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    
    .arrow i {
      font-size: 16px;
    }
    
    .arrow:hover {
      background-color: #ffd1dc;
      transform: translateY(-3px);
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
      margin-right: 10px;
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
      position: relative;
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
      top: 10px;
      right: 10px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      opacity: 0;
      transform: translateY(-10px);
      transition: all 0.3s ease;
      z-index: 10;
    }
    
    .product-card:hover .product-actions {
      opacity: 1;
      transform: translateY(0);
    }
    
    .action-btn {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #333;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .action-btn:hover {
      background-color: #ffd1dc;
      color: #333;
    }
    
    .action-btn.toggle-favorite.favorited {
      color: #ff5b79;
    }
    
    .product-action-form {
      display: contents;
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
    
    .testimonial-content::before {
      top: -10px;
      left: -15px;
    }
    
    .testimonial-content::after {
      bottom: -10px;
      right: -15px;
    }
    
    .testimonial-author {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .author-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 15px;
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
    .cta {
      padding: 80px 0;
      background-color: #f9f9f9;
      text-align: center;
    }
    
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
    
    .footer-column h3::after {
      content: '';
      position: absolute;
      width: 40px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: 0;
      left: 0;
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
    
    .newsletter {
      margin-top: 20px;
    }
    
    .newsletter form {
      display: flex;
    }
    
    .newsletter input {
      flex: 1;
      padding: 12px;
      border: none;
      border-radius: 4px 0 0 4px;
      font-family: inherit;
    }
    
    .newsletter button {
      background-color: #ffd1dc;
      color: #333;
      border: none;
      padding: 0 20px;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: inherit;
      font-weight: 500;
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
      
      .slide .hero-image {
        opacity: 0.5;
        width: 100%;
        right: -20%;
      }
    }
    
    @media (max-width: 768px) {
      nav ul {
        display: none;
      }
      
      .mobile-menu-btn {
        display: block;
      }
      
      .slide .hero-content {
        text-align: center;
        margin: 0 auto;
      }
      
      .slide .hero-cta {
        justify-content: center;
      }
      
      .slide .hero-image {
        opacity: 0.3;
      }
      
      .features-grid {
        grid-template-columns: 1fr;
      }
      
      .header-icons {
        display: none;
      }
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
      
      .slide .hero-content h1 {
        font-size: 32px;
      }
      
      .slide .hero-content p {
        font-size: 16px;
      }
      
      .section-header h2 {
        font-size: 28px;
      }
      
      .section-header p {
        font-size: 16px;
      }
      
      .slider-arrows {
        padding: 0 15px;
      }
      
      .arrow {
        width: 40px;
        height: 40px;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div class="container">
      <div class="header-content">
        <a href="{{ route('landing') }}" class="logo">Ele<span>gance</span></a>
        
        <nav>
          <ul>
            <li><a href="{{ route('landing') }}">{{ __('Home') }}</a></li>
            <li><a href="{{ route('designers.index') }}">{{ __('Designers') }}</a></li>
            <li><a href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
            <li><a href="{{ route('courses.index') }}">{{ __('Courses') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
            <li><a href="{{ route('blog') }}">{{ __('Blog') }}</a></li>
          </ul>
        </nav>
        
        <div class="header-icons">
          <a href="{{ route('favorites.index') }}" class="icon-btn" title="Favorites">
            <i class="fas fa-heart"></i>
            @if(auth()->user() && auth()->user()->favorites()->count() > 0)
              <span class="counter favorites-counter">{{ auth()->user()->favorites()->count() }}</span>
            @endif
          </a>
          <a href="{{ route('cart.index') }}" class="icon-btn" title="Cart">
            <i class="fas fa-shopping-cart"></i>
            @if(session()->has('cart') && count(session('cart')) > 0)
              <span class="counter cart-counter">{{ count(session('cart')) }}</span>
            @endif
          </a>
        </div>
        
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

  <!-- Hero Slider Section -->
  <section class="hero-slider" id="hero">
    <!-- Slide 1 -->
    <div class="slide active">
      <div class="container">
        <div class="hero-content">
          <h1>{{ __('Your Creative Space for Exceptional') }} <strong>{{ __('Fashion') }}</strong></h1>
          <p>{{ __('A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.') }}</p>
          <div class="hero-cta">
            <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Shop Now') }}</a>
            <a href="{{ route('designers.index') }}" class="btn btn-secondary">{{ __('Explore Designers') }}</a>
          </div>
        </div>
      </div>
      <div class="hero-image">
        <img src="{{ asset('img/hero-image.jpg') }}" alt="{{ __('Fashion showcase') }}">
      </div>
    </div>
    
    <!-- Slide 2 -->
    <div class="slide">
      <div class="container">
        <div class="hero-content">
          <h1>{{ __('Custom Designs') }} <strong>{{ __('Just For You') }}</strong></h1>
          <p>{{ __('Work directly with talented designers to create unique pieces that express your personal style and vision.') }}</p>
          <div class="hero-cta">
            <a href="{{ route('designers.index') }}" class="btn btn-secondary">{{ __('Meet Our Designers') }}</a>
          </div>
        </div>
      </div>
      <div class="hero-image">
        <img src="{{ asset('https://cdn.clo3d.com/web/article/scoop/thumbnail/4452725e73344ecd8f6b1b7bc033bd6c.jpg') }}" alt="{{ __('Custom fashion designs') }}">
      </div>
    </div>
    
    <!-- Slide 3 -->
    <div class="slide">
      <div class="container">
        <div class="hero-content">
          <h1>{{ __('Learn Fashion Design') }} <strong>{{ __('From Experts') }}</strong></h1>
          <p>{{ __('Enhance your skills with our premium courses taught by industry professionals and renowned fashion designers.') }}</p>
          <div class="hero-cta">
            <a href="{{ route('courses.index') }}" class="btn btn-primary">{{ __('Browse Courses') }}</a>
            <a href="{{ route('blog') }}" class="btn btn-secondary">{{ __('Read Our Blog') }}</a>
          </div>
        </div>
      </div>
      <div class="hero-image">
        <img src="{{ asset('https://cdn.clo3d.com/web/article/scoop/thumbnail/c38bad0185f148cebd3c5c0e8b0f0709.png') }}" alt="{{ __('Fashion design courses') }}">
      </div>
    </div>
    
    <!-- Slider Navigation Dots -->
    <div class="slider-dots">
      <span class="dot active" data-slide="0"></span>
      <span class="dot" data-slide="1"></span>
      <span class="dot" data-slide="2"></span>
    </div>
    
    <!-- Slider Arrows -->
    <div class="slider-arrows">
      <button class="arrow prev"><i class="fas fa-chevron-left"></i></button>
      <button class="arrow next"><i class="fas fa-chevron-right"></i></button>
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
              <a href="{{ route('products.show', $product->id) }}" class="action-btn" title="View Details">
                <i class="fas fa-eye"></i>
              </a>
              
              <form action="{{ route('cart.add') }}" method="POST" class="product-action-form">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="size" value="M">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="action-btn add-to-cart" title="Add to Cart">
                  <i class="fas fa-shopping-cart"></i>
                </button>
              </form>
              
              @auth
                <form action="{{ route('favorites.toggle') }}" method="POST" class="product-action-form favorite-form">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <button type="submit" class="action-btn toggle-favorite {{ auth()->user()->hasFavorited($product->id) ? 'favorited' : '' }}" 
                          title="{{ auth()->user()->hasFavorited($product->id) ? 'Remove from Favorites' : 'Add to Favorites' }}">
                    <i class="fas fa-heart"></i>
                  </button>
                </form>
              @else
                <a href="{{ route('login') }}" class="action-btn" title="Add to Favorites">
                  <i class="fas fa-heart"></i>
                </a>
              @endauth
            </div>
          </div>
          <div class="product-info">
            <h3 class="product-name">{{ $product->name }}</h3>
            <p class="product-designer">Design by: {{ $product->designer->name }}</p>
            <span class="product-price">
              @if($product->hasDiscount())
                <span class="original-price">${{ number_format($product->price, 2) }}</span>
                <span class="discount-price">${{ number_format($product->discounted_price, 2) }}</span>
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

  <!-- Courses Section -->
  <section class="courses" id="courses">
    <div class="container">
      <div class="section-header">
        <h2>Featured Courses</h2>
        <p>Learn fashion design from our professional designers</p>
      </div>
      <div class="courses-grid">
        @foreach($featuredCourses as $course)
        <div class="course-card">
          <img src="{{ $course->image ? asset('storage/'.$course->image) : '/api/placeholder/400/200' }}" alt="{{ $course->title }}" class="course-image">
          <div class="course-info">
            <span class="course-category">{{ $course->category ? $course->category->name : 'Fashion Design' }}</span>
            <h3 class="course-title">{{ $course->title }}</h3>
            <div class="course-instructor">
              <img src="{{ $course->designer->profile_picture ? asset('storage/'.$course->designer->profile_picture) : '/api/placeholder/40/40' }}" alt="{{ $course->designer->name }}" class="instructor-avatar">
              <span class="instructor-name">{{ $course->designer->name }}</span>
            </div>
            <div class="course-meta">
              <span class="course-price">${{ number_format($course->price, 2) }}</span>
              <a href="{{ route('courses.show', $course->id) }}" class="course-action">Learn More</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="view-all-btn">
        <a href="{{ route('courses.index') }}" class="btn btn-outline">View All Courses</a>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta" id="contact">
    <div class="container">
      <h2>Start Your Fashion Journey Today</h2>
      <p>Join our platform to explore exclusive designs, connect with talented designers, and learn fashion design skills</p>
      <a href="{{ route('register') }}" class="btn btn-primary">Create Account</a>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <h3>About Elegance</h3>
          <p>A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="footer-column">
          <h3>Quick Links</h3>
          <ul class="footer-links">
            <li><a href="{{ route('landing') }}">Home</a></li>
            <li><a href="{{ route('products.index') }}">Products</a></li>
            <li><a href="{{ route('designers.index') }}">Designers</a></li>
            <li><a href="{{ route('courses.index') }}">Courses</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Contact Info</h3>
          <ul class="footer-links">
            <li><i class="fas fa-map-marker-alt"></i> 123 Fashion Street, Amman, Jordan</li>
            <li><i class="fas fa-phone"></i> +962 77 123 4567</li>
            <li><i class="fas fa-envelope"></i> info@elegance.com</li>
          </ul>
          <div class="newsletter">
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
              @csrf
              <input type="email" name="email" placeholder="Join our newsletter">
              <button type="submit">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Elegance. All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    // Scroll header effect
    window.addEventListener('scroll', function() {
      const header = document.querySelector('header');
      if (window.scrollY > 50) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navMenu = document.querySelector('nav ul');

    mobileMenuBtn.addEventListener('click', function() {
      navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === "#") return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 80,
            behavior: 'smooth'
          });
          
          // Close mobile menu after clicking
          if (window.innerWidth < 768) {
            navMenu.style.display = 'none';
          }
        }
      });
    });

    // Hero Slider Functionality
    document.addEventListener('DOMContentLoaded', function() {
      const slides = document.querySelectorAll('.slide');
      const dots = document.querySelectorAll('.dot');
      const prevArrow = document.querySelector('.arrow.prev');
      const nextArrow = document.querySelector('.arrow.next');
      let currentSlide = 0;
      const totalSlides = slides.length;
      let slideInterval;
      
      // Initialize the slider
      function startSlider() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
      }
      
      // Show a specific slide
      function showSlide(index) {
        // Deactivate all slides and dots
        slides.forEach(slide => slide.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        
        // Activate the current slide and dot
        slides[index].classList.add('active');
        dots[index].classList.add('active');
        
        // Update current slide index
        currentSlide = index;
      }
      
      // Next slide function
      function nextSlide() {
        let next = currentSlide + 1;
        if (next >= totalSlides) next = 0;
        showSlide(next);
      }
      
      // Previous slide function
      function prevSlide() {
        let prev = currentSlide - 1;
        if (prev < 0) prev = totalSlides - 1;
        showSlide(prev);
      }
      
      // Event listeners for dots
      dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
          clearInterval(slideInterval);
          showSlide(index);
          startSlider();
        });
      });
      
      // Event listeners for arrows
      prevArrow.addEventListener('click', () => {
        clearInterval(slideInterval);
        prevSlide();
        startSlider();
      });
      
      nextArrow.addEventListener('click', () => {
        clearInterval(slideInterval);
        nextSlide();
        startSlider();
      });
      
      // Start the slider
      startSlider();
    });

    // AJAX functionality for favorite toggle
    document.addEventListener('DOMContentLoaded', function() {
      const favoritesForms = document.querySelectorAll('.favorite-form');
      
      favoritesForms.forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const formData = new FormData(this);
          const button = this.querySelector('.toggle-favorite');
          const productId = formData.get('product_id');
          
          fetch(this.action, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'X-Requested-With': 'XMLHttpRequest',
              'Accept': 'application/json'
            },
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'success') {
              // Toggle the button appearance
              button.classList.toggle('favorited');
              
              // Update tooltip/title
              if (button.classList.contains('favorited')) {
                button.setAttribute('title', 'Remove from Favorites');
              } else {
                button.setAttribute('title', 'Add to Favorites');
              }
              
              // Update favorites counter in navbar if it exists
              const counter = document.querySelector('.favorites-counter');
              if (counter) {
                // If favorites count is 0, remove the counter
                if (data.count === 0) {
                  counter.remove();
                } else {
                  counter.textContent = data.count;
                }
              } else if (data.count > 0) {
                // If counter doesn't exist but count is > 0, create counter
                const favoritesIcon = document.querySelector('.icon-btn[title="Favorites"]');
                if (favoritesIcon) {
                  const newCounter = document.createElement('span');
                  newCounter.className = 'counter favorites-counter';
                  newCounter.textContent = data.count;
                  favoritesIcon.appendChild(newCounter);
                  
                  // Also set the heart icon color
                  favoritesIcon.querySelector('i').style.color = '#ff5b79';
                }
              }
              
              // Optional: Show a toast notification
              if (typeof showToast === 'function') {
                showToast(data.message);
              }
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
        });
      });
    });
  </script>
</body>
</html>