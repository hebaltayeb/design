<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ __('Fashion Designers') }} - {{ config('app.name', 'Elegance') }}</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: '{{ app()->getLocale() == 'ar' ? 'Tajawal' : 'Poppins' }}', sans-serif;
    }
    
    body {
      background-color: #f8f9fa;
      color: #2c3e50;
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
      box-shadow: 0 4px 20px rgba(196, 69, 105, 0.1);
      transition: all 0.3s ease;
    }
    
    header.scrolled {
      background-color: #fff;
      box-shadow: 0 6px 30px rgba(196, 69, 105, 0.15);
    }
    
    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 18px 0;
    }
    
    .logo {
      font-size: 32px;
      font-weight: 300;
      color: #2c3e50;
      text-decoration: none;
      letter-spacing: 1px;
    }
    
    .logo span {
      font-weight: 700;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    nav ul {
      display: flex;
      list-style: none;
    }
    
    nav ul li {
      margin: 0 15px;
    }
    
    nav ul li a {
      text-decoration: none;
      color: #2c3e50;
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
      padding: 8px 0;
    }
    
    nav ul li a:hover,
    nav ul li a.active {
      color: #c44569;
    }
    
    nav ul li a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 3px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      bottom: 0;
      left: 0;
      transition: width 0.3s ease;
      border-radius: 2px;
    }
    
    nav ul li a:hover::after,
    nav ul li a.active::after {
      width: 100%;
    }
    
    .header-icons {
      display: flex;
      gap: 20px;
      align-items: center;
    }
    
    .icon-btn {
      color: #2c3e50;
      font-size: 20px;
      position: relative;
      transition: all 0.3s ease;
      text-decoration: none;
      padding: 8px;
      border-radius: 50%;
    }
    
    .icon-btn:hover {
      color: #c44569;
      background: rgba(255, 107, 157, 0.1);
      transform: translateY(-2px);
    }
    
    .counter {
      position: absolute;
      top: 2px;
      right: 2px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      font-size: 11px;
      width: 18px;
      height: 18px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
    }
    
    .cta-buttons {
      display: flex;
      gap: 15px;
    }
    
    .btn {
      padding: 12px 24px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      border: none;
      cursor: pointer;
    }
    
    .btn-outline {
      border: 2px solid #2c3e50;
      color: #2c3e50;
      background: transparent;
    }
    
    .btn-outline:hover {
      background: #2c3e50;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(44, 62, 80, 0.3);
    }
    
    .btn-primary {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border: 2px solid transparent;
    }
    
    .btn-primary:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    .mobile-menu-btn {
      display: none;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: #2c3e50;
    }
    
    /* Page Header */
    .page-header {
      padding: 140px 0 60px;
      text-align: center;
      background: linear-gradient(135deg, rgba(255, 107, 157, 0.05) 0%, rgba(196, 69, 105, 0.05) 100%);
    }
    
    .page-title {
      font-size: 48px;
      font-weight: 300;
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
      padding-bottom: 20px;
      color: #2c3e50;
    }
    
    .page-title::after {
      content: '';
      position: absolute;
      width: 80px;
      height: 4px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      border-radius: 2px;
    }
    
    .page-description {
      max-width: 700px;
      margin: 0 auto;
      color: #666;
      font-size: 18px;
      line-height: 1.6;
    }
    
    /* Main Content */
    .main-content {
      padding: 60px 0;
    }
    
    /* Filter Section */
    .filter-section {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 50px;
      box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .filter-controls {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }
    
    .search-box {
      position: relative;
      max-width: 400px;
      width: 100%;
    }
    
    .search-input {
      width: 100%;
      padding: 15px 20px 15px 50px;
      border: 2px solid #e1e8ed;
      border-radius: 50px;
      font-size: 16px;
      outline: none;
      transition: all 0.3s ease;
      background: #fff;
    }
    
    .search-input:focus {
      border-color: #c44569;
      box-shadow: 0 0 20px rgba(196, 69, 105, 0.2);
    }
    
    .search-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #666;
      font-size: 18px;
    }
    
    .search-btn {
      position: absolute;
      right: 5px;
      top: 5px;
      height: calc(100% - 10px);
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: white;
      border: none;
      border-radius: 50px;
      padding: 0 25px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-weight: 600;
    }
    
    .search-btn:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
      transform: scale(1.05);
    }
    
    .filter-dropdowns {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }
    
    .filter-dropdown {
      position: relative;
    }
    
    .filter-select {
      padding: 15px 20px;
      border: 2px solid #e1e8ed;
      border-radius: 50px;
      font-size: 14px;
      outline: none;
      appearance: none;
      background: #fff url("data:image/svg+xml;utf8,<svg fill='%23666' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat;
      background-position: right 15px center;
      background-size: 20px;
      padding-right: 45px;
      cursor: pointer;
      transition: all 0.3s ease;
      min-width: 150px;
    }
    
    .filter-select:focus {
      border-color: #c44569;
      box-shadow: 0 0 20px rgba(196, 69, 105, 0.2);
    }
    
    .results-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      padding: 0 10px;
    }
    
    .results-count {
      color: #666;
      font-size: 16px;
    }
    
    .view-toggle {
      display: flex;
      gap: 10px;
    }
    
    .view-btn {
      width: 40px;
      height: 40px;
      border: 2px solid #e1e8ed;
      background: #fff;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      color: #666;
    }
    
    .view-btn.active,
    .view-btn:hover {
      border-color: #c44569;
      background: #c44569;
      color: #fff;
    }
    
    /* Designers Grid */
    .designers-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 40px;
      margin-bottom: 60px;
    }
    
    .designers-grid.list-view {
      grid-template-columns: 1fr;
    }
    
    .designer-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
      transition: all 0.4s ease;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .designer-card:hover {
      transform: translateY(-15px) scale(1.02);
      box-shadow: 0 20px 50px rgba(196, 69, 105, 0.2);
    }
    
    .designers-grid.list-view .designer-card {
      display: flex;
      align-items: center;
    }
    
    .designers-grid.list-view .designer-card:hover {
      transform: translateY(-5px);
    }
    
    .designer-image {
      width: 100%;
      height: 320px;
      position: relative;
      overflow: hidden;
    }
    
    .designers-grid.list-view .designer-image {
      width: 200px;
      height: 200px;
      flex-shrink: 0;
    }
    
    .designer-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.4s ease;
    }
    
    .designer-card:hover .designer-image img {
      transform: scale(1.05);
    }
    
    .featured-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      padding: 8px 15px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .designer-info {
      padding: 30px;
      text-align: center;
    }
    
    .designers-grid.list-view .designer-info {
      text-align: left;
      flex: 1;
    }
    
    .designer-name {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #2c3e50;
    }
    
    .designer-specialty {
      font-size: 16px;
      color: #666;
      margin-bottom: 20px;
    }
    
    .designer-stats {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-bottom: 25px;
    }
    
    .designers-grid.list-view .designer-stats {
      justify-content: flex-start;
    }
    
    .designer-stat {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    
    .designers-grid.list-view .designer-stat {
      align-items: flex-start;
    }
    
    .stat-count {
      font-size: 20px;
      font-weight: 700;
      color: #2c3e50;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    
    .stat-label {
      font-size: 12px;
      color: #999;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 2px;
    }
    
    .designer-social {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 25px;
    }
    
    .designers-grid.list-view .designer-social {
      justify-content: flex-start;
    }
    
    .social-link {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #f8f9fa;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      text-decoration: none;
    }
    
    .social-link:hover {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      transform: translateY(-3px);
    }
    
    .view-profile {
      display: inline-block;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      padding: 12px 30px;
      border-radius: 25px;
      text-decoration: none;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s ease;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .view-profile:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
    }
    
    /* Pagination */
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 60px;
    }
    
    .pagination-list {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
      gap: 10px;
    }
    
    .pagination-item {
      display: flex;
    }
    
    .pagination-link {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 45px;
      height: 45px;
      border-radius: 10px;
      color: #2c3e50;
      text-decoration: none;
      transition: all 0.3s ease;
      border: 2px solid #e1e8ed;
      background: #fff;
      font-weight: 500;
    }
    
    .pagination-link:hover,
    .pagination-link.active {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border-color: transparent;
      transform: translateY(-2px);
    }
    
    .pagination-link.disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    
    /* Join CTA */
    .join-cta {
      background: linear-gradient(135deg, rgba(255, 107, 157, 0.1) 0%, rgba(196, 69, 105, 0.1) 100%);
      border-radius: 25px;
      padding: 60px 40px;
      text-align: center;
      margin-top: 80px;
    }
    
    .join-cta h2 {
      font-size: 36px;
      font-weight: 300;
      margin-bottom: 20px;
      color: #2c3e50;
    }
    
    .join-cta p {
      color: #666;
      max-width: 600px;
      margin: 0 auto 30px;
      font-size: 18px;
      line-height: 1.6;
    }
    
    /* Footer */
    footer {
      background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
      color: #ecf0f1;
      padding: 80px 0 30px;
      margin-top: 100px;
    }
    
    .footer-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-bottom: 50px;
    }
    
    .footer-column {
      flex: 1;
      min-width: 250px;
      margin-bottom: 40px;
    }
    
    .footer-column h3 {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 15px;
      color: #fff;
    }
    
    .footer-column h3::after {
      content: '';
      position: absolute;
      width: 50px;
      height: 3px;
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      bottom: 0;
      left: 0;
      border-radius: 2px;
    }
    
    .footer-column p {
      font-size: 15px;
      color: #bdc3c7;
      margin-bottom: 25px;
      line-height: 1.6;
    }
    
    .footer-links {
      list-style: none;
    }
    
    .footer-links li {
      margin-bottom: 12px;
    }
    
    .footer-links li a {
      color: #bdc3c7;
      text-decoration: none;
      font-size: 15px;
      transition: all 0.3s ease;
      padding: 5px 0;
      display: inline-block;
    }
    
    .footer-links li a:hover {
      color: #ff6b9d;
      transform: translateX(5px);
    }
    
    .social-links {
      display: flex;
      gap: 15px;
    }
    
    .social-links a {
      color: #bdc3c7;
      font-size: 20px;
      transition: all 0.3s ease;
      padding: 10px;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.05);
    }
    
    .social-links a:hover {
      color: #ff6b9d;
      background: rgba(255, 107, 157, 0.1);
      transform: translateY(-3px);
    }
    
    .newsletter {
      margin-top: 25px;
    }
    
    .newsletter form {
      display: flex;
      border-radius: 25px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .newsletter input {
      flex: 1;
      padding: 15px 20px;
      border: none;
      font-family: inherit;
      font-size: 14px;
      background: #fff;
    }
    
    .newsletter button {
      background: linear-gradient(45deg, #ff6b9d, #c44569);
      color: #fff;
      border: none;
      padding: 0 25px;
      cursor: pointer;
      transition: all 0.3s ease;
      font-family: inherit;
      font-weight: 600;
    }
    
    .newsletter button:hover {
      background: linear-gradient(45deg, #c44569, #ff6b9d);
    }
    
    .footer-bottom {
      text-align: center;
      padding-top: 30px;
      border-top: 1px solid #455a64;
      font-size: 14px;
      color: #95a5a6;
    }
    
    /* Loading State */
    .loading {
      text-align: center;
      padding: 60px 0;
    }
    
    .loading-spinner {
      width: 50px;
      height: 50px;
      border: 3px solid #f3f3f3;
      border-top: 3px solid #c44569;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      margin: 0 auto 20px;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 80px 20px;
    }
    
    .empty-icon {
      font-size: 80px;
      color: #e1e8ed;
      margin-bottom: 20px;
    }
    
    .empty-message {
      font-size: 24px;
      color: #666;
      margin-bottom: 10px;
    }
    
    .empty-description {
      color: #999;
      margin-bottom: 30px;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
      .page-title {
        font-size: 40px;
      }
      
      .filter-controls {
        flex-direction: column;
        align-items: stretch;
      }
      
      .search-box {
        max-width: 100%;
        margin-bottom: 20px;
      }
      
      .filter-dropdowns {
        justify-content: center;
      }
      
      .designers-grid {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      }
    }
    
    @media (max-width: 768px) {
      nav ul {
        display: none;
      }
      
      .mobile-menu-btn {
        display: block;
      }
      
      .header-icons {
        display: none;
      }
      
      .cta-buttons {
        display: none;
      }
      
      .page-title {
        font-size: 32px;
      }
      
      .designers-grid.list-view .designer-card {
        flex-direction: column;
      }
      
      .designers-grid.list-view .designer-image {
        width: 100%;
        height: 250px;
      }
      
      .designers-grid.list-view .designer-info {
        text-align: center;
      }
      
      .designers-grid.list-view .designer-stats {
        justify-content: center;
      }
      
      .designers-grid.list-view .designer-social {
        justify-content: center;
      }
      
      .join-cta {
        padding: 40px 20px;
      }
    }
    
    @media (max-width: 576px) {
      .filter-section {
        padding: 20px;
      }
      
      .filter-dropdowns {
        flex-direction: column;
        width: 100%;
      }
      
      .filter-select {
        width: 100%;
      }
      
      .designers-grid {
        grid-template-columns: 1fr;
      }
      
      .designer-stats {
        gap: 20px;
      }
      
      .results-info {
        flex-direction: column;
        gap: 15px;
        text-align: center;
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
            <li><a href="{{ route('designers.index') }}" class="active">{{ __('Designers') }}</a></li>
            <li><a href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
            <li><a href="{{ route('courses.index') }}">{{ __('Courses') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
          </ul>
        </nav>
        
        <div class="header-icons">
          <a href="{{ route('favorites.index') }}" class="icon-btn" title="{{ __('Favorites') }}">
            <i class="fas fa-heart"></i>
            @auth
              @if(auth()->user()->favorites()->count() > 0)
                <span class="counter favorites-counter">{{ auth()->user()->favorites()->count() }}</span>
              @endif
            @endauth
          </a>
          
          <a href="{{ route('cart.index') }}" class="icon-btn" title="{{ __('Cart') }}">
            <i class="fas fa-shopping-cart"></i>
            @if(session()->has('cart') && !empty(session('cart')))
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
  
  <!-- Page Header -->
  <div class="page-header">
    <div class="container">
      <h1 class="page-title">{{ __('Our Fashion Designers') }}</h1>
      <p class="page-description">{{ __('Discover talented designers from around the world who are creating exclusive fashion pieces for our platform') }}</p>
    </div>
  </div>
  
  <div class="container">
    <div class="main-content">
      <!-- Filter Section -->
      <div class="filter-section">
        <form method="GET" action="{{ route('designers.index') }}" id="filter-form">
          <div class="filter-controls">
            <div class="search-box">
              <i class="fas fa-search search-icon"></i>
              <input type="text" name="search" class="search-input" placeholder="{{ __('Search for designers...') }}" value="{{ request('search') }}">
              <button type="submit" class="search-btn">{{ __('Search') }}</button>
            </div>
            
            <div class="filter-dropdowns">
              <div class="filter-dropdown">
                <select name="specialty" class="filter-select" onchange="document.getElementById('filter-form').submit()">
                  <option value="">{{ __('All Specialties') }}</option>
                  <option value="contemporary" {{ request('specialty') == 'contemporary' ? 'selected' : '' }}>{{ __('Contemporary Fashion') }}</option>
                  <option value="classic" {{ request('specialty') == 'classic' ? 'selected' : '' }}>{{ __('Classic Fashion') }}</option>
                  <option value="conservative" {{ request('specialty') == 'conservative' ? 'selected' : '' }}>{{ __('Conservative Fashion') }}</option>
                  <option value="bridal" {{ request('specialty') == 'bridal' ? 'selected' : '' }}>{{ __('Bridal Fashion') }}</option>
                  <option value="casual" {{ request('specialty') == 'casual' ? 'selected' : '' }}>{{ __('Casual Wear') }}</option>
                  <option value="formal" {{ request('specialty') == 'formal' ? 'selected' : '' }}>{{ __('Formal Wear') }}</option>
                </select>
              </div>
              
              <div class="filter-dropdown">
                <select name="sort" class="filter-select" onchange="document.getElementById('filter-form').submit()">
                  <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>{{ __('Most Popular') }}</option>
                  <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('Newest') }}</option>
                  <option value="alphabetical" {{ request('sort') == 'alphabetical' ? 'selected' : '' }}>{{ __('Alphabetical') }}</option>
                  <option value="products" {{ request('sort') == 'products' ? 'selected' : '' }}>{{ __('Most Products') }}</option>
                  <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>{{ __('Highest Rated') }}</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      
      <!-- Results Info -->
      <div class="results-info">
        <div class="results-count">
          {{ __('Showing :from-:to of :total designers', [
            'from' => $designers->firstItem() ?? 0,
            'to' => $designers->lastItem() ?? 0,
            'total' => $designers->total()
          ]) }}
        </div>
        <div class="view-toggle">
          <button class="view-btn active" data-view="grid" title="{{ __('Grid View') }}">
            <i class="fas fa-th"></i>
          </button>
          <button class="view-btn" data-view="list" title="{{ __('List View') }}">
            <i class="fas fa-list"></i>
          </button>
        </div>
      </div>
      
      <!-- Loading State -->
      <div class="loading" id="loading" style="display: none;">
        <div class="loading-spinner"></div>
        <p>{{ __('Loading designers...') }}</p>
      </div>
      
      <!-- Designers Grid -->
      @if($designers->count() > 0)
        <div class="designers-grid" id="designers-grid">
          @foreach($designers as $designer)
          <div class="designer-card" data-designer-id="{{ $designer->id }}">
            <div class="designer-image">
              <img src="{{ $designer->profile_picture ? asset('storage/' . $designer->profile_picture) : '/api/placeholder/400/320' }}" alt="{{ $designer->name }}">
              @if($designer->is_featured ?? false)
                <div class="featured-badge">{{ __('Featured') }}</div>
              @endif
            </div>
            <div class="designer-info">
              <h3 class="designer-name">{{ $designer->name }}</h3>
              <p class="designer-specialty">{{ $designer->specialty ?? __('Fashion Designer') }}</p>
              
              <div class="designer-stats">
                <div class="designer-stat">
                  <span class="stat-count">{{ $designer->products_count ?? $designer->products->count() ?? 0 }}</span>
                  <span class="stat-label">{{ __('Products') }}</span>
                </div>
                <div class="designer-stat">
                  <span class="stat-count">{{ $designer->courses_count ?? $designer->courses->count() ?? 0 }}</span>
                  <span class="stat-label">{{ __('Courses') }}</span>
                </div>
                <div class="designer-stat">
                  <span class="stat-count">{{ $designer->events_count ?? $designer->events->count() ?? 0 }}</span>
                  <span class="stat-label">{{ __('Events') }}</span>
                </div>
              </div>
              
              
              
              <a href="{{ route('designers.show', $designer->id) }}" class="view-profile">{{ __('View Profile') }}</a>
            </div>
          </div>
          @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
          <ul class="pagination-list">
            @if ($designers->onFirstPage())
              <li class="pagination-item">
                <span class="pagination-link disabled">
                  <i class="fas fa-chevron-left"></i>
                </span>
              </li>
            @else
              <li class="pagination-item">
                <a href="{{ $designers->previousPageUrl() }}" class="pagination-link">
                  <i class="fas fa-chevron-left"></i>
                </a>
              </li>
            @endif
            
            @foreach ($designers->getUrlRange(1, $designers->lastPage()) as $page => $url)
              <li class="pagination-item">
                <a href="{{ $url }}" class="pagination-link {{ $page == $designers->currentPage() ? 'active' : '' }}">
                  {{ $page }}
                </a>
              </li>
            @endforeach
            
            @if ($designers->hasMorePages())
              <li class="pagination-item">
                <a href="{{ $designers->nextPageUrl() }}" class="pagination-link">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </li>
            @else
              <li class="pagination-item">
                <span class="pagination-link disabled">
                  <i class="fas fa-chevron-right"></i>
                </span>
              </li>
            @endif
          </ul>
        </div>
      @else
        <!-- Empty State -->
        <div class="empty-state">
          <div class="empty-icon">
            <i class="fas fa-user-friends"></i>
          </div>
          <h3 class="empty-message">{{ __('No designers found') }}</h3>
          <p class="empty-description">{{ __('Try adjusting your search criteria or browse all designers') }}</p>
          <a href="{{ route('designers.index') }}" class="btn btn-primary">{{ __('View All Designers') }}</a>
        </div>
      @endif
      
      <!-- Join CTA -->
      <div class="join-cta">
        <h2>{{ __('Are You a Fashion Designer?') }}</h2>
        <p>{{ __('Join our platform to showcase your creative designs, offer custom pieces, and connect with customers from around the world.') }}</p>
        <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Join as Designer') }}</a>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <a href="{{ route('landing') }}" class="logo">Ele<span>gance</span></a>
          <p>{{ __('A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.') }}</p>
          <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
          </div>
        </div>
        
        <div class="footer-column">
          <h3>{{ __('Quick Links') }}</h3>
          <ul class="footer-links">
            <li><a href="{{ route('landing') }}">{{ __('Home') }}</a></li>
            <li><a href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
            <li><a href="{{ route('designers.index') }}">{{ __('Designers') }}</a></li>
            <li><a href="{{ route('courses.index') }}">{{ __('Courses') }}</a></li>
            <li><a href="{{ route('about') }}">{{ __('About Us') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
          </ul>
        </div>
        
        <div class="footer-column">
          <h3>{{ __('Contact Info') }}</h3>
          <div class="footer-links">
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
              <i class="fas fa-map-marker-alt" style="margin-right: 15px; color: #ff6b9d;"></i>
              <span>{{ __('123 Fashion Street, Amman, Jordan') }}</span>
            </div>
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
              <i class="fas fa-phone-alt" style="margin-right: 15px; color: #ff6b9d;"></i>
              <span>+962 77 123 4567</span>
            </div>
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
              <i class="fas fa-envelope" style="margin-right: 15px; color: #ff6b9d;"></i>
              <span>info@elegance.com</span>
            </div>
          </div>
          <div class="newsletter">
            <form action="{{ route('newsletter.subscribe') }}" method="POST">
              @csrf
              <input type="email" name="email" placeholder="{{ __('Join our newsletter') }}" required>
              <button type="submit">{{ __('Subscribe') }}</button>
            </form>
          </div>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} {{ __('Elegance. All Rights Reserved.') }}</p>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Header scroll effect
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

      if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
          navMenu.style.display = navMenu.style.display === 'flex' ? 'none' : 'flex';
        });
      }

      // View toggle functionality
      const viewButtons = document.querySelectorAll('.view-btn');
      const designersGrid = document.getElementById('designers-grid');

      viewButtons.forEach(button => {
        button.addEventListener('click', function() {
          const view = this.dataset.view;
          
          // Update active button
          viewButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          
          // Update grid class
          if (view === 'list') {
            designersGrid.classList.add('list-view');
          } else {
            designersGrid.classList.remove('list-view');
          }
          
          // Save preference
          localStorage.setItem('designers-view', view);
        });
      });

      // Load saved view preference
      const savedView = localStorage.getItem('designers-view');
      if (savedView) {
        const viewBtn = document.querySelector(`[data-view="${savedView}"]`);
        if (viewBtn) {
          viewBtn.click();
        }
      }

      // Search functionality with debounce
      const searchInput = document.querySelector('.search-input');
      const filterForm = document.getElementById('filter-form');
      let searchTimeout;

      if (searchInput) {
        searchInput.addEventListener('input', function() {
          clearTimeout(searchTimeout);
          searchTimeout = setTimeout(() => {
            // Auto-submit form after user stops typing
            if (this.value.length >= 3 || this.value.length === 0) {
              showLoading();
              filterForm.submit();
            }
          }, 500);
        });
      }

      // Filter change handlers
      const filterSelects = document.querySelectorAll('.filter-select');
      filterSelects.forEach(select => {
        select.addEventListener('change', function() {
          showLoading();
        });
      });

      // Show loading state
      function showLoading() {
        const loading = document.getElementById('loading');
        const designersGrid = document.getElementById('designers-grid');
        if (loading && designersGrid) {
          loading.style.display = 'block';
          designersGrid.style.opacity = '0.5';
        }
      }

      // Animate designer cards on scroll
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, observerOptions);

      // Observe all designer cards
      const designerCards = document.querySelectorAll('.designer-card');
      designerCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
      });

      // Smooth scroll for pagination
      const paginationLinks = document.querySelectorAll('.pagination-link');
      paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          if (!this.classList.contains('disabled')) {
            showLoading();
            // Scroll to top of results
            document.querySelector('.filter-section').scrollIntoView({
              behavior: 'smooth'
            });
          }
        });
      });

      // Clear filters functionality
      const clearFiltersBtn = document.createElement('button');
      clearFiltersBtn.type = 'button';
      clearFiltersBtn.className = 'btn btn-outline';
      clearFiltersBtn.textContent = '{{ __("Clear Filters") }}';
      clearFiltersBtn.style.marginLeft = '15px';
      
      clearFiltersBtn.addEventListener('click', function() {
        // Clear all form inputs
        document.querySelector('.search-input').value = '';
        document.querySelectorAll('.filter-select').forEach(select => {
          select.selectedIndex = 0;
        });
        
        // Submit form
        showLoading();
        window.location.href = '{{ route("designers.index") }}';
      });

      // Add clear filters button if there are active filters
      const hasActiveFilters = {{ request()->hasAny(['search', 'specialty', 'sort']) ? 'true' : 'false' }};
      if (hasActiveFilters) {
        const filterControls = document.querySelector('.filter-controls');
        filterControls.appendChild(clearFiltersBtn);
      }

      // Keyboard shortcuts
      document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
          e.preventDefault();
          searchInput.focus();
        }
        
        // Escape to clear search
        if (e.key === 'Escape' && document.activeElement === searchInput) {
          searchInput.value = '';
          searchInput.blur();
        }
      });
    });
  </script>
</body>
</html>