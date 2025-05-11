<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $designer->name }} - Fashion Designer Profile</title>
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
    
    .designer-header {
      padding-top: 80px;
      margin-bottom: 50px;
    }
    
    .breadcrumb {
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }
    
    .breadcrumb a {
      color: #666;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .breadcrumb a:hover {
      color: #ffd1dc;
    }
    
    .breadcrumb .separator {
      margin: 0 10px;
      color: #ccc;
    }
    
    .breadcrumb .current {
      color: #000;
    }
    
    .designer-profile {
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }
    
    .profile-banner {
      height: 300px;
      background-color: #f0f0f0;
      position: relative;
      overflow: hidden;
    }
    
    .profile-banner img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    .profile-info {
      display: flex;
      padding: 0 30px 30px;
      position: relative;
    }
    
    .profile-avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      border: 5px solid white;
      position: relative;
      margin-top: -75px;
      background-color: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .profile-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }
    
    .profile-details {
      padding-left: 30px;
      flex: 1;
    }
    
    .profile-name {
      font-size: 28px;
      font-weight: 500;
      margin-bottom: 5px;
    }
    
    .profile-specialty {
      color: #666;
      margin-bottom: 15px;
      font-size: 16px;
    }
    
    .profile-bio {
      color: #666;
      margin-bottom: 20px;
      line-height: 1.8;
    }
    
    .profile-stats {
      display: flex;
      gap: 30px;
      margin-bottom: 20px;
    }
    
    .profile-stat {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    
    .stat-count {
      font-size: 24px;
      font-weight: 500;
    }
    
    .stat-label {
      font-size: 14px;
      color: #999;
    }
    
    .profile-social {
      display: flex;
      gap: 15px;
    }
    
    .profile-social a {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #f5f5f5;
      color: #666;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      font-size: 18px;
    }
    
    .profile-social a:hover {
      background-color: #000;
      color: white;
    }
    
    .follow-button {
      position: absolute;
      right: 30px;
      top: 30px;
      background-color: #000;
      color: white;
      padding: 10px 25px;
      border-radius: 30px;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    
    .follow-button:hover {
      background-color: #333;
    }
    
    .follow-button.following {
      background-color: transparent;
      color: #000;
      border: 1px solid #000;
    }
    
    .featured-badge {
      position: absolute;
      top: 20px;
      left: 20px;
      background-color: #ffd1dc;
      color: #333;
      padding: 5px 15px;
      border-radius: 30px;
      font-size: 12px;
      font-weight: 500;
    }
    
    .tabs-container {
      margin-top: 50px;
    }
    
    .tabs-navigation {
      display: flex;
      border-bottom: 1px solid #eee;
      margin-bottom: 30px;
      gap: 10px;
    }
    
    .tab-button {
      padding: 15px 25px;
      cursor: pointer;
      font-weight: 500;
      border-bottom: 2px solid transparent;
      transition: all 0.3s ease;
      background: none;
      border-top: none;
      border-left: none;
      border-right: none;
    }
    
    .tab-button.active {
      border-color: #ffd1dc;
      color: #000;
    }
    
    .tab-content {
      display: none;
      animation: fadeIn 0.5s ease;
    }
    
    .tab-content.active {
      display: block;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    .section-title {
      font-size: 24px;
      font-weight: 500;
      margin-bottom: 30px;
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
    
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }
    
    .product-card {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .product-image {
      width: 100%;
      height: 270px;
      overflow: hidden;
      position: relative;
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
    
    .product-action {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #333;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }
    
    .product-action:hover {
      background-color: #000;
      color: white;
    }
    
    .discount-badge {
      position: absolute;
      top: 15px;
      left: 15px;
      background-color: #ffd1dc;
      color: #333;
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 12px;
      font-weight: 500;
    }
    
    .product-info {
      padding: 20px;
    }
    
    .product-name {
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 10px;
    }
    
    .product-price {
      display: flex;
      align-items: center;
      margin-bottom: 15px;
    }
    
    .current-price {
      font-weight: 500;
      font-size: 18px;
    }
    
    .original-price {
      color: #999;
      text-decoration: line-through;
      margin-left: 10px;
      font-size: 14px;
    }
    
    .product-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .product-rating {
      color: #ffc107;
      font-size: 14px;
    }
    
    .product-rating span {
      color: #666;
      margin-left: 5px;
    }
    
    .product-category {
      color: #999;
      font-size: 14px;
    }
    
    .load-more {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    
    .load-more-btn {
      background-color: transparent;
      color: #000;
      border: 1px solid #000;
      padding: 10px 30px;
      border-radius: 30px;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .load-more-btn:hover {
      background-color: #000;
      color: white;
    }
    
    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }
    
    .course-card {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .course-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .course-image {
      width: 100%;
      height: 200px;
      overflow: hidden;
    }
    
    .course-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    
    .course-card:hover .course-image img {
      transform: scale(1.05);
    }
    
    .course-info {
      padding: 20px;
    }
    
    .course-category {
      display: inline-block;
      background-color: #f0f0f0;
      padding: 5px 15px;
      border-radius: 30px;
      font-size: 12px;
      color: #666;
      margin-bottom: 15px;
    }
    
    .course-title {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 15px;
      line-height: 1.4;
    }
    
    .course-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-top: 15px;
      border-top: 1px solid #eee;
    }
    
    .course-stats {
      display: flex;
      gap: 15px;
      color: #666;
      font-size: 14px;
    }
    
    .course-stat {
      display: flex;
      align-items: center;
    }
    
    .course-stat i {
      margin-right: 5px;
    }
    
    .course-price {
      font-weight: 500;
      font-size: 18px;
    }
    
    .events-list {
      margin-bottom: 40px;
    }
    
    .event-card {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      margin-bottom: 20px;
      display: flex;
      transition: all 0.3s ease;
    }
    
    .event-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .event-date {
      width: 100px;
      background-color: #000;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    
    .event-day {
      font-size: 24px;
      font-weight: 700;
    }
    
    .event-month {
      font-size: 14px;
      text-transform: uppercase;
    }
    
    .event-year {
      font-size: 14px;
    }
    
    .event-info {
      flex: 1;
      padding: 20px;
    }
    
    .event-title {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 10px;
    }
    
    .event-details {
      color: #666;
      margin-bottom: 15px;
    }
    
    .event-location {
      display: flex;
      align-items: center;
      color: #666;
      font-size: 14px;
    }
    
    .event-location i {
      margin-right: 10px;
      color: #ffd1dc;
    }
    
    .event-action {
      margin-left: auto;
      display: flex;
      align-items: center;
    }
    
    .event-button {
      background-color: #ffd1dc;
      color: #333;
      padding: 10px 25px;
      border-radius: 30px;
      text-decoration: none;
      font-size: 14px;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .event-button:hover {
      background-color: #ffb6c1;
    }
    
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 40px;
    }
    
    .gallery-item {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .gallery-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .gallery-image {
      width: 100%;
      height: 220px;
      object-fit: cover;
    }
    
    .contact-section {
      background-color: #f5f5f5;
      border-radius: 8px;
      padding: 30px;
      margin-bottom: 40px;
    }
    
    .contact-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    
    .contact-form .form-group:last-child {
      grid-column: span 2;
    }
    
    .form-group {
      margin-bottom: 15px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
    }
    
    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 10px 15px;
      border: 1px solid #ddd;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #ffd1dc;
      box-shadow: 0 0 10px rgba(255, 209, 220, 0.2);
    }
    
    .form-group textarea {
      height: 120px;
      resize: vertical;
    }
    
    .submit-btn {
      background-color: #000;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      font-size: 14px;
      transition: all 0.3s ease;
      font-weight: 500;
    }
    
    .submit-btn:hover {
      background-color: #333;
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
    
    @media (max-width: 992px) {
      .profile-info {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      
      .profile-details {
        padding-left: 0;
        padding-top: 20px;
      }
      
      .profile-stats {
        justify-content: center;
      }
      
      .profile-social {
        justify-content: center;
      }
      
      .follow-button {
        position: relative;
        right: auto;
        top: auto;
        margin-top: 20px;
      }
      
      .courses-grid {
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      }
      
      .event-card {
        flex-direction: column;
      }
      
      .event-date {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        padding: 10px;
      }
      
      .event-day, .event-month, .event-year {
        font-size: 16px;
      }
    }
    
    @media (max-width: 768px) {
      .tabs-navigation {
        flex-wrap: wrap;
      }
      
      .tab-button {
        flex: 1;
        padding: 10px 15px;
        font-size: 14px;
        text-align: center;
      }
      
      .products-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      }
      
      .contact-form {
        grid-template-columns: 1fr;
      }
      
      .contact-form .form-group:last-child {
        grid-column: span 1;
      }
    }
    
    @media (max-width: 576px) {
      .profile-avatar {
        width: 120px;
        height: 120px;
        margin-top: -60px;
      }
      
      .profile-name {
        font-size: 24px;
      }
      
      .products-grid, .gallery-grid {
        grid-template-columns: 1fr 1fr;
      }
      
      .courses-grid {
        grid-template-columns: 1fr;
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
    <div class="designer-header">
      <div class="breadcrumb">
        <a href="/">Home</a>
        <span class="separator"><i class="fas fa-chevron-right"></i></span>
        <a href="/designers">Designers</a>
        <span class="separator"><i class="fas fa-chevron-right"></i></span>
        <span class="current">{{ $designer->name }}</span>
      </div>
      
      <div class="designer-profile">
        <div class="profile-banner">
          <img src="/api/placeholder/1200/300" alt="Designer Banner">
          @if($designer->is_featured)
          <div class="featured-badge">Featured Designer</div>
          @endif
        </div>
        
        <div class="profile-info">
          <div class="profile-avatar">
            <img src="{{ $designer->profile_picture ? asset('storage/' . $designer->profile_picture) : '/api/placeholder/150/150' }}" alt="{{ $designer->name }}">
          </div>
          
          <div class="profile-details">
            <h1 class="profile-name">{{ $designer->name }}</h1>
            <p class="profile-specialty">{{ $designer->specialty ?? 'Fashion Designer' }}</p>
            <p class="profile-bio">{{ $designer->bio ?? 'A passionate fashion designer dedicated to creating timeless and elegant pieces that empower women to express their unique style with confidence.' }}</p>
            
            <div class="profile-stats">
              <div class="profile-stat">
                <span class="stat-count">{{ $designer->products->count() }}</span>
                <span class="stat-label">Products</span>
              </div>
              <div class="profile-stat">
                <span class="stat-count">{{ $designer->courses->count() }}</span>
                <span class="stat-label">Courses</span>
              </div>
              <div class="profile-stat">
                <span class="stat-count">{{ $designer->events->count() }}</span>
                <span class="stat-label">Events</span>
              </div>
              <div class="profile-stat">
                <span class="stat-count">0</span>
                <span class="stat-label">Followers</span>
              </div>
            </div>
            
            <div class="profile-social">
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-pinterest"></i></a>
              <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
          </div>
          
          <a href="#" class="follow-button">Follow</a>
        </div>
      </div>
    </div>
    
    <div class="tabs-container">
      <div class="tabs-navigation">
        <button class="tab-button active" data-tab="products">Products</button>
        <button class="tab-button" data-tab="courses">Courses</button>
        <button class="tab-button" data-tab="events">Upcoming Events</button>
        <button class="tab-button" data-tab="gallery">Gallery</button>
        <button class="tab-button" data-tab="contact">Contact</button>
      </div>
      
      <!-- Products Tab -->
      <div class="tab-content active" id="products-tab">
        <h2 class="section-title">Designer Products</h2>
        
        <div class="products-grid">
          @foreach($designer->products as $product)
          <div class="product-card">
            <div class="product-image">
              <img src="{{ $product->image ? asset('storage/' . $product->image) : '/api/placeholder/270/270' }}" alt="{{ $product->name }}">
              
              @if($product->hasDiscount())
              <div class="discount-badge">Sale</div>
              @endif
              
              <div class="product-actions">
                <a href="{{ route('products.show', $product->id) }}" class="product-action"><i class="fas fa-eye"></i></a>
                <a href="#" class="product-action"><i class="fas fa-shopping-cart"></i></a>
                <a href="#" class="product-action"><i class="far fa-heart"></i></a>
              </div>
            </div>
            
            <div class="product-info">
              <h3 class="product-name">{{ $product->name }}</h3>
              
              <div class="product-price">
                @if($product->hasDiscount())
                <span class="current-price">${{ number_format($product->discounted_price, 2) }}</span>
                <span class="original-price">${{ number_format($product->price, 2) }}</span>
                @else
                <span class="current-price">${{ number_format($product->price, 2) }}</span>
                @endif
              </div>
              
              <div class="product-meta">
                <div class="product-rating">
                  @php
                    $avgRating = $product->ratings->avg('rating') ?? 0;
                    $roundedRating = round($avgRating);
                  @endphp
                  
                  @for($i = 1; $i <= 5; $i++)
                    @if($i <= $roundedRating)
                      <i class="fas fa-star"></i>
                    @else
                      <i class="far fa-star"></i>
                    @endif
                  @endfor
                  
                  <span>({{ $product->ratings->count() }})</span>
                </div>
                
                <div class="product-category">{{ $product->category }}</div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        @if($designer->products->count() > 8)
        <div class="load-more">
          <button class="load-more-btn">Load More</button>
        </div>
        @endif
      </div>
      
      <!-- Courses Tab -->
      <div class="tab-content" id="courses-tab">
        <h2 class="section-title">Designer Courses</h2>
        
        @if($designer->courses->count() > 0)
        <div class="courses-grid">
          @foreach($designer->courses as $course)
          <div class="course-card">
            <div class="course-image">
              <img src="{{ $course->image ? asset('storage/' . $course->image) : '/api/placeholder/350/200' }}" alt="{{ $course->title }}">
            </div>
            
            <div class="course-info">
              <span class="course-category">{{ $course->category->name ?? 'Fashion Design' }}</span>
              <h3 class="course-title">{{ $course->title }}</h3>
              <p>{{ \Illuminate\Support\Str::limit($course->description, 100) }}</p>
              
              <div class="course-meta">
                <div class="course-stats">
                  <div class="course-stat">
                    <i class="fas fa-user"></i> {{ $course->enrollments->count() }}
                  </div>
                  <div class="course-stat">
                    <i class="fas fa-clock"></i> {{ $course->duration ?? '12h' }}
                  </div>
                  <div class="course-stat">
                    <i class="fas fa-film"></i> {{ $course->lessons_count ?? '24' }}
                  </div>
                </div>
                
                <div class="course-price">${{ number_format($course->price, 2) }}</div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <p>This designer hasn't published any courses yet. Check back soon for new learning opportunities!</p>
        @endif
      </div>
      
      <!-- Events Tab -->
      <div class="tab-content" id="events-tab">
        <h2 class="section-title">Upcoming Events</h2>
        
        @if($designer->events->count() > 0)
        <div class="events-list">
          @foreach($designer->events as $event)
          <div class="event-card">
            <div class="event-date">
              <span class="event-day">{{ $event->event_date->format('d') }}</span>
              <span class="event-month">{{ $event->event_date->format('M') }}</span>
              <span class="event-year">{{ $event->event_date->format('Y') }}</span>
            </div>
            
            <div class="event-info">
              <h3 class="event-title">{{ $event->title }}</h3>
              <p class="event-details">{{ \Illuminate\Support\Str::limit($event->description, 150) }}</p>
              
              <div class="event-location">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $event->location }}</span>
              </div>
            </div>
            
            <div class="event-action">
              <a href="#" class="event-button">Learn More</a>
            </div>
          </div>
          @endforeach
        </div>
        @else
        <p>No upcoming events scheduled. Check back soon for new fashion shows and events!</p>
        @endif
      </div>
      
      <!-- Gallery Tab -->
      <div class="tab-content" id="gallery-tab">
        <h2 class="section-title">Designer Gallery</h2>
        
        @if(isset($mediaItems) && $mediaItems->count() > 0)
        <div class="gallery-grid">
          @foreach($mediaItems as $media)
          <div class="gallery-item">
            <img src="{{ asset('storage/' . $media->media_url) }}" alt="Designer Work" class="gallery-image">
          </div>
          @endforeach
        </div>
        @else
        <div class="gallery-grid">
          <!-- Placeholder gallery items -->
          @for($i = 1; $i <= 8; $i++)
          <div class="gallery-item">
            <img src="/api/placeholder/220/220?text=Gallery+{{ $i }}" alt="Designer Work" class="gallery-image">
          </div>
          @endfor
        </div>
        @endif
      </div>
      
      <!-- Contact Tab -->
      <div class="tab-content" id="contact-tab">
        <h2 class="section-title">Contact Designer</h2>
        
        <div class="contact-section">
          <form class="contact-form">
            <div class="form-group">
              <label for="name">Your Name</label>
              <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
              <label for="email">Your Email</label>
              <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" name="subject" required>
            </div>
            
            <div class="form-group">
              <label for="message">Your Message</label>
              <textarea id="message" name="message" required></textarea>
            </div>
            
            <div class="form-group">
              <button type="submit" class="submit-btn">Send Message</button>
            </div>
          </form>
        </div>
      </div>
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
  
  <script>
    // Tab navigation functionality
    document.querySelectorAll('.tab-button').forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.tab-button').forEach(tab => {
          tab.classList.remove('active');
        });
        
        // Hide all tab content
        document.querySelectorAll('.tab-content').forEach(content => {
          content.classList.remove('active');
        });
        
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Show corresponding tab content
        const tabId = this.getAttribute('data-tab');
        document.getElementById(tabId + '-tab').classList.add('active');
      });
    });
    
    // Follow button functionality
    const followButton = document.querySelector('.follow-button');
    followButton.addEventListener('click', function(e) {
      e.preventDefault();
      
      if (this.classList.contains('following')) {
        this.textContent = 'Follow';
        this.classList.remove('following');
      } else {
        this.textContent = 'Following';
        this.classList.add('following');
      }
    });
    
    // Load more products functionality
    const loadMoreBtn = document.querySelector('.load-more-btn');
    if (loadMoreBtn) {
      loadMoreBtn.addEventListener('click', function() {
        // This would typically be an AJAX request to load more products
        // For now, we'll just show a message
        this.textContent = 'Loading...';
        
        setTimeout(() => {
          this.textContent = 'No more products to load';
          this.disabled = true;
          this.style.opacity = '0.5';
        }, 1500);
      });
    }
    
    // Contact form submission
    const contactForm = document.querySelector('.contact-form');
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form values
      const name = this.querySelector('#name').value;
      const email = this.querySelector('#email').value;
      const subject = this.querySelector('#subject').value;
      const message = this.querySelector('#message').value;
      
      // Validate form (simple validation)
      if (!name || !email || !subject || !message) {
        alert('Please fill all fields');
        return;
      }
      
      // This would typically be an AJAX request to send the message
      // For now, we'll just show a success message
      
      // Create success message
      const successMessage = document.createElement('div');
      successMessage.style.backgroundColor = '#dff0d8';
      successMessage.style.color = '#3c763d';
      successMessage.style.padding = '15px';
      successMessage.style.borderRadius = '5px';
      successMessage.style.marginBottom = '20px';
      successMessage.style.textAlign = 'center';
      successMessage.innerHTML = '<i class="fas fa-check-circle"></i> Your message has been sent successfully! We\'ll get back to you soon.';
      
      // Add success message to the form
      this.parentNode.insertBefore(successMessage, this);
      
      // Reset form
      this.reset();
      
      // Remove success message after 5 seconds
      setTimeout(() => {
        successMessage.remove();
      }, 5000);
    });
  </script>
</body>
</html>