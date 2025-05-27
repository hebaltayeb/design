<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('My Favorites') }} - {{ config('app.name', 'Elegance') }}</title>
    <link href="https://fonts.googleapis.com/css2?family={{ app()->getLocale() == 'ar' ? 'Tajawal' : 'Poppins' }}:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
        
        /* Header Styles - Matching designers page */
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
            display: inline-flex;
            align-items: center;
            justify-content: center;
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
        
        .filter-dropdowns {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
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
        
        /* Favorites Grid */
        .favorites-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        
        .favorites-container.list-view {
            grid-template-columns: 1fr;
        }
        
        .product-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            transition: all 0.4s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .product-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 50px rgba(196, 69, 105, 0.2);
        }
        
        .favorites-container.list-view .product-card {
            display: flex;
            align-items: center;
        }
        
        .favorites-container.list-view .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            width: 100%;
            height: 280px;
            position: relative;
            overflow: hidden;
        }
        
        .favorites-container.list-view .product-image {
            width: 200px;
            height: 200px;
            flex-shrink: 0;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-actions {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateY(0);
        }
        
        .action-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2c3e50;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .action-btn:hover {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
            transform: translateY(-3px);
        }
        
        .action-btn.remove-favorite {
            color: #ff5b79;
        }
        
        .action-btn.remove-favorite:hover {
            background: #ff5b79;
            color: #fff;
        }
        
        .sale-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .product-info {
            padding: 25px;
        }
        
        .favorites-container.list-view .product-info {
            flex: 1;
        }
        
        .product-name {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        
        .product-designer {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .product-price {
            font-weight: 700;
            font-size: 18px;
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 10px;
            font-weight: normal;
            font-size: 16px;
        }
        
        .discount-price {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid rgba(196, 69, 105, 0.1);
        }
        
        .product-rating {
            color: #ffc107;
            font-size: 14px;
        }
        
        .product-date {
            font-size: 12px;
            color: #999;
        }
        
        /* Empty State */
        .empty-favorites {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .empty-icon {
            font-size: 80px;
            color: rgba(196, 69, 105, 0.3);
            margin-bottom: 25px;
        }
        
        .empty-message {
            font-size: 26px;
            font-weight: 400;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .empty-description {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }
        
        /* Checkout Section */
        .checkout-section {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            margin-top: 40px;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .checkout-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 30px;
        }
        
        .checkout-stat {
            text-align: center;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-label {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Toast Notifications */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(45deg, #27ae60, #2ecc71);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.error {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
        }
        
        /* Footer - Matching designers page */
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
            
            .favorites-container {
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
            
            .favorites-container.list-view .product-card {
                flex-direction: column;
            }
            
            .favorites-container.list-view .product-image {
                width: 100%;
                height: 250px;
            }
            
            .favorites-container.list-view .product-info {
                text-align: center;
            }
            
            .checkout-stats {
                flex-direction: column;
                gap: 20px;
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
            
            .favorites-container {
                grid-template-columns: 1fr;
            }
            
            .results-info {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .product-actions {
                flex-direction: row;
                opacity: 1;
                transform: none;
                top: auto;
                bottom: 15px;
                right: 15px;
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
                        <li><a href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
                        <li><a href="{{ route('designers.index') }}">{{ __('Designers') }}</a></li>
                        <li><a href="{{ route('courses.index') }}">{{ __('Courses') }}</a></li>
                        <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                    </ul>
                </nav>
                
                <div class="header-icons">
                    <a href="{{ route('favorites.index') }}" class="icon-btn active" title="{{ __('Favorites') }}">
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
            <h1 class="page-title">{{ __('My Favorites') }}</h1>
            <p class="page-description">{{ __('Your collection of favorite designs from our talented designers') }}</p>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toastNotification"></div>

    <div class="container">
        <div class="main-content">
            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-controls">
                    <div class="search-box">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="{{ __('Search your favorites...') }}" id="search-favorites">
                    </div>
                    
                    <div class="filter-dropdowns">
                        
                        
                        <select class="filter-select" id="filter-designer">
                            <option value="">{{ __('All Designers') }}</option>
                            @foreach($favorites->pluck('product.designer')->unique('id')->filter() as $designer)
                                <option value="{{ $designer->id }}">{{ $designer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Results Info -->
            <div class="results-info">
                <div class="results-count">
                    {{ __('Showing :count of :total favorites', [
                        'count' => count($favorites),
                        'total' => count($favorites)
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

            <!-- Favorites Grid -->
            <div class="favorites-container" id="favorites-container">
                @if(count($favorites) > 0)
                    @foreach($favorites as $favorite)
                    <div class="product-card" id="favorite-{{ $favorite->product->id }}" data-designer-id="{{ optional($favorite->product->designer)->id }}" data-name="{{ $favorite->product->name }}" data-price="{{ $favorite->product->price }}" data-date="{{ $favorite->created_at->timestamp }}">
                        <div class="product-image">
                            <img src="{{ $favorite->product->image_url ?? '/api/placeholder/400/280?text=Product+Image' }}" alt="{{ $favorite->product->name }}">
                            
                            @if($favorite->product->discount && $favorite->product->discount->percentage > 0)
                                <div class="sale-badge">{{ __('Sale') }}</div>
                            @endif
                            
                            <div class="product-actions">
                                <button class="action-btn remove-favorite" 
                                        title="{{ __('Remove from Favorites') }}" 
                                        data-id="{{ $favorite->product->id }}"
                                        data-url="{{ route('favorites.toggle') }}">
                                    <i class="fas fa-heart"></i>
                                </button>
                                <a href="{{ route('products.show', $favorite->product->id) }}" 
                                   class="action-btn" 
                                   title="{{ __('View Details') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('favorites.add-all-to-cart') }}" method="POST" id="add-all-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $favorite->product->id }}">
                                    <input type="hidden" name="size" value="M">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="action-btn" title="{{ __('Add to Cart') }}">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="product-info">
                            <h3 class="product-name">{{ $favorite->product->name }}</h3>
                            <p class="product-designer">{{ __('by') }} {{ optional($favorite->product->designer)->name ?? __('Unknown Designer') }}</p>
                            <div class="product-price">
                                @if($favorite->product->discount && $favorite->product->discount->percentage > 0)
                                    <span class="original-price">${{ number_format($favorite->product->price, 2) }}</span>
                                    <span class="discount-price">${{ number_format($favorite->product->price * (1 - $favorite->product->discount->percentage / 100), 2) }}</span>
                                @else
                                    ${{ number_format($favorite->product->price, 2) }}
                                @endif
                            </div>
                            <div class="product-meta">
                                <div class="product-rating">
                                    @php
                                        $avgRating = $favorite->product->ratings->avg('rating') ?? 0;
                                        $fullStars = floor($avgRating);
                                        $halfStar = $avgRating - $fullStars >= 0.5;
                                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                    @endphp
                                    
                                    @for($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    
                                    @if($halfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    
                                    @for($i = 0; $i < $emptyStars; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                    
                                    <span>({{ number_format($avgRating, 1) }})</span>
                                </div>
                                <div class="product-date">{{ __('Added') }} {{ $favorite->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="empty-favorites" id="empty-favorites">
                        <div class="empty-icon">
                            <i class="far fa-heart"></i>
                        </div>
                        <h3 class="empty-message">{{ __('Your favorites list is empty') }}</h3>
                        <p class="empty-description">{{ __('Save your favorite designs to come back to them later') }}</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Browse Products') }}</a>
                    </div>
                @endif
            </div>

            @if(count($favorites) > 0)
                <!-- Checkout Section -->
                <div class="checkout-section">
                    <div class="checkout-stats">
                        <div class="checkout-stat">
                            <div class="stat-value" id="total-items">{{ count($favorites) }}</div>
                            <div class="stat-label">{{ __('Favorite Items') }}</div>
                        </div>
                        <div class="checkout-stat">
                            <div class="stat-value">
                                ${{ number_format($favorites->sum(function($favorite) {
                                    return $favorite->product->discount && $favorite->product->discount->percentage > 0 
                                        ? $favorite->product->price * (1 - $favorite->product->discount->percentage / 100)
                                        : $favorite->product->price;
                                }), 2) }}
                            </div>
                            <div class="stat-label">{{ __('Total Value') }}</div>
                        </div>
                        <div class="checkout-stat">
                            <div class="stat-value">{{ $favorites->pluck('product.designer')->unique('id')->filter()->count() }}</div>
                            <div class="stat-label">{{ __('Designers') }}</div>
                        </div>
                    </div>
                    
                    <form action="{{ route('favorites.add-all-to-cart') }}" method="POST" id="add-all-form">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i>
                            {{ __('Add All to Cart') }}
                        </button>
                    </form>
                </div>

                <!-- Pagination -->
                @if(isset($favorites) && method_exists($favorites, 'links'))
                <div class="pagination">
                    <ul class="pagination-list">
                        {{ $favorites->links() }}
                    </ul>
                </div>
                @endif
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <a href="{{ route('landing') }}" class="logo" style="color: #fff; font-size: 32px; font-weight: 300; text-decoration: none; letter-spacing: 1px;">Ele<span style="font-weight: 700; background: linear-gradient(45deg, #ff6b9d, #c44569); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">gance</span></a>
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
            // Setup CSRF Token for AJAX requests
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
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

            // Toast notification function
            function showToast(message, type = 'success') {
                const toast = document.getElementById('toastNotification');
                toast.textContent = message;
                toast.className = `toast show ${type}`;
                
                setTimeout(() => {
                    toast.className = 'toast';
                }, 3000);
            }

            // View toggle functionality
            const viewButtons = document.querySelectorAll('.view-btn');
            const favoritesContainer = document.getElementById('favorites-container');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const view = this.dataset.view;
                    
                    // Update active button
                    viewButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update grid class
                    if (view === 'list') {
                        favoritesContainer.classList.add('list-view');
                    } else {
                        favoritesContainer.classList.remove('list-view');
                    }
                    
                    // Save preference
                    localStorage.setItem('favorites-view', view);
                });
            });

            // Load saved view preference
            const savedView = localStorage.getItem('favorites-view');
            if (savedView) {
                const viewBtn = document.querySelector(`[data-view="${savedView}"]`);
                if (viewBtn) {
                    viewBtn.click();
                }
            }

            // Search functionality
            const searchInput = document.getElementById('search-favorites');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterFavorites();
                }, 300);
            });

            // Sort functionality
            const sortSelect = document.getElementById('sort-favorites');
            sortSelect.addEventListener('change', filterFavorites);

            // Designer filter
            const designerFilter = document.getElementById('filter-designer');
            designerFilter.addEventListener('change', filterFavorites);

            // Filter favorites function
            function filterFavorites() {
                const searchTerm = searchInput.value.toLowerCase();
                const sortBy = sortSelect.value;
                const designerId = designerFilter.value;
                const productCards = Array.from(document.querySelectorAll('.product-card:not(#empty-favorites)'));

                // Filter cards
                let visibleCards = productCards.filter(card => {
                    const name = card.dataset.name.toLowerCase();
                    const cardDesignerId = card.dataset.designerId;
                    
                    const matchesSearch = name.includes(searchTerm);
                    const matchesDesigner = !designerId || cardDesignerId === designerId;
                    
                    return matchesSearch && matchesDesigner;
                });

                // Sort cards
                visibleCards.sort((a, b) => {
                    switch(sortBy) {
                        case 'oldest':
                            return parseInt(a.dataset.date) - parseInt(b.dataset.date);
                        case 'price-low':
                            return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                        case 'price-high':
                            return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                        case 'name':
                            return a.dataset.name.localeCompare(b.dataset.name);
                        default: // newest
                            return parseInt(b.dataset.date) - parseInt(a.dataset.date);
                    }
                });

                // Hide all cards first
                productCards.forEach(card => {
                    card.style.display = 'none';
                });

                // Show filtered and sorted cards
                visibleCards.forEach((card, index) => {
                    card.style.display = 'block';
                    card.style.order = index;
                });

                // Update results count
                const resultsCount = document.querySelector('.results-count');
                const totalItems = document.getElementById('total-items');
                
                resultsCount.textContent = `{{ __('Showing') }} ${visibleCards.length} {{ __('of') }} ${productCards.length} {{ __('favorites') }}`;
                if (totalItems) {
                    totalItems.textContent = visibleCards.length;
                }

                // Show/hide empty state
                const emptyState = document.getElementById('empty-favorites');
                if (visibleCards.length === 0 && productCards.length > 0) {
                    if (!emptyState) {
                        const emptyDiv = document.createElement('div');
                        emptyDiv.id = 'empty-favorites';
                        emptyDiv.className = 'empty-favorites';
                        emptyDiv.innerHTML = `
                            <div class="empty-icon"><i class="fas fa-search"></i></div>
                            <h3 class="empty-message">{{ __('No favorites found') }}</h3>
                            <p class="empty-description">{{ __('Try adjusting your search or filters') }}</p>
                        `;
                        favoritesContainer.appendChild(emptyDiv);
                    } else {
                        emptyState.style.display = 'block';
                    }
                } else if (emptyState) {
                    emptyState.style.display = 'none';
                }
            }

            // Remove from favorites with AJAX
            document.querySelectorAll('.remove-favorite').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const url = this.getAttribute('data-url');
                    const productCard = this.closest('.product-card');
                    
                    // Show loading state
                    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    this.disabled = true;
                    
                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            product_id: productId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Update favorites counter in header
                            const counter = document.querySelector('.favorites-counter');
                            if (counter) {
                                const newCount = parseInt(counter.textContent) - 1;
                                if (newCount > 0) {
                                    counter.textContent = newCount;
                                } else {
                                    counter.remove();
                                }
                            }
                            
                            // Animate and remove product card
                            productCard.style.transition = 'all 0.3s ease';
                            productCard.style.opacity = '0';
                            productCard.style.transform = 'translateY(-20px)';
                            
                            setTimeout(() => {
                                productCard.remove();
                                
                                // Check if no favorites left
                                const remainingCards = document.querySelectorAll('.product-card:not(#empty-favorites)');
                                if (remainingCards.length === 0) {
                                    // Show empty state
                                    const emptyFav = document.createElement('div');
                                    emptyFav.className = 'empty-favorites';
                                    emptyFav.id = 'empty-favorites';
                                    emptyFav.innerHTML = `
                                        <div class="empty-icon"><i class="far fa-heart"></i></div>
                                        <h3 class="empty-message">{{ __('Your favorites list is empty') }}</h3>
                                        <p class="empty-description">{{ __('Save your favorite designs to come back to them later') }}</p>
                                        <a href="{{ route('products.index') }}" class="btn btn-primary">{{ __('Browse Products') }}</a>
                                    `;
                                    favoritesContainer.appendChild(emptyFav);
                                    
                                    // Hide checkout section
                                    const checkoutSection = document.querySelector('.checkout-section');
                                    if (checkoutSection) {
                                        checkoutSection.style.display = 'none';
                                    }
                                } else {
                                    // Update results count
                                    filterFavorites();
                                }
                            }, 300);
                            
                            showToast('{{ __("Product removed from favorites") }}');
                        } else {
                            // Restore button state
                            this.innerHTML = '<i class="fas fa-heart"></i>';
                            this.disabled = false;
                            showToast(data.message || '{{ __("Error removing product from favorites") }}', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error removing favorite:', error);
                        // Restore button state
                        this.innerHTML = '<i class="fas fa-heart"></i>';
                        this.disabled = false;
                        showToast('{{ __("Error connecting to server. Please try again.") }}', 'error');
                    });
                });
            });

            // Add to cart functionality
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const button = this.querySelector('button');
                    const originalContent = button.innerHTML;
                    
                    // Show loading state
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    button.disabled = true;
                    
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            showToast('{{ __("Product added to cart successfully!") }}');
                            
                            // Update cart counter in header
                            const cartCounter = document.querySelector('.cart-counter');
                            if (cartCounter) {
                                cartCounter.textContent = parseInt(cartCounter.textContent) + 1;
                            } else {
                                const cartIcon = document.querySelector('.icon-btn[title="{{ __('Cart') }}"]');
                                if (cartIcon) {
                                    const newCounter = document.createElement('span');
                                    newCounter.className = 'counter cart-counter';
                                    newCounter.textContent = '1';
                                    cartIcon.appendChild(newCounter);
                                }
                            }
                        } else {
                            showToast(data.message || '{{ __("Error adding product to cart") }}', 'error');
                        }
                        
                        // Restore button state
                        button.innerHTML = originalContent;
                        button.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error adding to cart:', error);
                        showToast('{{ __("Error connecting to server. Please try again.") }}', 'error');
                        
                        // Restore button state
                        button.innerHTML = originalContent;
                        button.disabled = false;
                    });
                });
            });

            // Add all to cart functionality
            const addAllForm = document.getElementById('add-all-form');
            if (addAllForm) {
                addAllForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const button = this.querySelector('button');
                    const originalContent = button.innerHTML;
                    
                    // Show loading state
                    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> {{ __("Adding to Cart...") }}';
                    button.disabled = true;
                    
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            showToast(`{{ __("Added") }} ${data.count} {{ __("items to cart successfully!") }}`);
                            
                            // Update cart counter
                            const cartCounter = document.querySelector('.cart-counter');
                            if (cartCounter) {
                                cartCounter.textContent = parseInt(cartCounter.textContent) + data.count;
                            } else {
                                const cartIcon = document.querySelector('.icon-btn[title="{{ __('Cart') }}"]');
                                if (cartIcon) {
                                    const newCounter = document.createElement('span');
                                    newCounter.className = 'counter cart-counter';
                                    newCounter.textContent = data.count;
                                    cartIcon.appendChild(newCounter);
                                }
                            }
                            
                            // Redirect to cart after success
                            setTimeout(() => {
                                window.location.href = '{{ route("cart.index") }}';
                            }, 1500);
                        } else {
                            showToast(data.message || '{{ __("Error adding products to cart") }}', 'error');
                        }
                        
                        // Restore button state
                        button.innerHTML = originalContent;
                        button.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error adding all to cart:', error);
                        showToast('{{ __("Error connecting to server. Please try again.") }}', 'error');
                        
                        // Restore button state
                        button.innerHTML = originalContent;
                        button.disabled = false;
                    });
                });
            }

            // Animate product cards on scroll
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

            // Observe all product cards
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach((card, index) => {
                if (!card.id.includes('empty')) {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                    observer.observe(card);
                }
            });

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
                    filterFavorites();
                    searchInput.blur();
                }
            });
        });
    </script>
</body>
</html>