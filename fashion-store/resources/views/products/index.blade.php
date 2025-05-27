<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Products</title>
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
        
        /* Header Styles - Updated to match designers page */
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
        
        .products-container {
            display: flex;
            gap: 30px;
        }
        
        .filter-sidebar {
            width: 280px;
            flex-shrink: 0;
        }
        
        .filter-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(196, 69, 105, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .filter-card h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(196, 69, 105, 0.1);
            color: #2c3e50;
            position: relative;
        }
        
        .filter-card h3::after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            bottom: -1px;
            left: 0;
            border-radius: 2px;
        }
        
        .filter-group {
            margin-bottom: 20px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 15px;
            color: #2c3e50;
        }
        
        .filter-group select,
        .filter-group input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #fff;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        
        .filter-group select:focus,
        .filter-group input[type="number"]:focus {
            outline: none;
            border-color: #c44569;
            box-shadow: 0 0 20px rgba(196, 69, 105, 0.2);
        }
        
        .color-options {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .color-option:hover,
        .color-option.active {
            border-color: #c44569;
            transform: scale(1.1);
        }
        
        .filter-button {
            width: 100%;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        
        .filter-button:hover {
            background: linear-gradient(45deg, #c44569, #ff6b9d);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(196, 69, 105, 0.3);
        }
        
        .products-grid {
            flex: 1;
        }
        
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 0 10px;
        }
        
        .products-count {
            font-size: 16px;
            color: #666;
        }
        
        .sort-options select {
            padding: 12px 20px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .sort-options select:focus {
            outline: none;
            border-color: #c44569;
            box-shadow: 0 0 20px rgba(196, 69, 105, 0.2);
        }
        
        .products-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
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
        
        .product-image {
            position: relative;
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
        
        .product-actions a:hover,
        .product-actions button:hover {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
            transform: translateY(-3px);
        }

        .product-actions .favorite-btn.favorited {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 8px 15px;
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .product-info {
            padding: 25px;
        }
        
        .product-name {
            font-size: 18px;
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
            display: flex;
            align-items: center;
            font-weight: 700;
            font-size: 16px;
            color: #2c3e50;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 8px;
            font-weight: normal;
        }
        
        .discount-price {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
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
        
        .pagination a {
            display: flex;
            width: 45px;
            height: 45px;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid #e1e8ed;
            background: #fff;
            font-weight: 500;
        }
        
        .pagination a:hover,
        .pagination a.active {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            color: #fff;
            border-color: transparent;
            transform: translateY(-2px);
        }

        /* Toast notification styles */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(45deg, #2c3e50, #34495e);
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

        .toast.success {
            background: linear-gradient(45deg, #27ae60, #2ecc71);
        }

        .toast.error {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
        }

        /* Loading spinner */
        .loading-spinner {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            z-index: 9998;
            justify-content: center;
            align-items: center;
        }

        .loading-spinner.active {
            display: flex;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #c44569;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .no-products {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
        }
        
        .no-products i {
            font-size: 80px;
            color: #e1e8ed;
            margin-bottom: 20px;
        }
        
        .no-products h3 {
            font-size: 24px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .no-products p {
            color: #999;
            margin-bottom: 30px;
        }

        /* Footer - Updated to match designers page */
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
        
        @media (max-width: 992px) {
            .products-container {
                flex-direction: column;
            }
            
            .filter-sidebar {
                width: 100%;
                margin-bottom: 30px;
            }

            .page-title {
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
            
            .header-icons {
                display: none;
            }
            
            .cta-buttons {
                display: none;
            }

            .products-list {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
            
            .products-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .page-title {
                font-size: 32px;
            }
        }

        @media (max-width: 576px) {
            .products-list {
                grid-template-columns: 1fr;
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
                        <li><a href="{{ route('landing') }}">Home</a></li>
                        <li><a href="{{ route('products.index') }}" class="active">Products</a></li>
                        <li><a href="{{ route('designers.index') }}">Designers</a></li>
                        <li><a href="{{ route('courses.index') }}">Courses</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
                
                <div class="header-icons">
                    <a href="{{ route('favorites.index') }}" class="icon-btn" title="Favorites">
                        <i class="fas fa-heart"></i>
                        @auth
                            @if(auth()->user()->favorites()->count() > 0)
                                <span class="counter favorites-counter">{{ auth()->user()->favorites()->count() }}</span>
                            @endif
                        @endauth
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="icon-btn" title="Cart">
                        <i class="fas fa-shopping-cart"></i>
                        @if(session()->has('cart') && !empty(session('cart')))
                            <span class="counter cart-counter">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </div>
                
                <div class="cta-buttons">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">Sign In</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Create Account</a>
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
            <h1 class="page-title">Fashion Products</h1>
            <p class="page-description">Explore our exclusive collection of designer fashion pieces crafted by talented designers from around the world</p>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner"></div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toastNotification"></div>

    <div class="container">
        <div class="main-content">
            <div class="products-container">
                <!-- Filter Sidebar -->
                <div class="filter-sidebar">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="filter-card">
                            <h3>Filter Products</h3>
                            
                            <!-- Designer Filter -->
                            <div class="filter-group">
                                <label for="designer">Designer</label>
                                <select name="designer" id="designer">
                                    <option value="">All Designers</option>
                                    @foreach($designers as $designer)
                                        <option value="{{ $designer->id }}" {{ request('designer') == $designer->id ? 'selected' : '' }}>
                                            {{ $designer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Clothing Type Filter -->
                            <div class="filter-group">
                                <label for="category">Clothing Type</label>
                                <select name="category" id="category">
                                    <option value="">All Types</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <!-- Price Range Filter -->
                            <div class="filter-group">
                                <label>Price Range</label>
                                <input type="number" name="min_price" placeholder="Min Price" value="{{ request('min_price') }}" min="0">
                                <input type="number" name="max_price" placeholder="Max Price" value="{{ request('max_price') }}" min="0">
                            </div>
                            
                            <!-- Color Filter -->
                            <div class="filter-group">
                                <label>Color</label>
                                <select name="color" id="color">
                                    <option value="">All Colors</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color }}" {{ request('color') == $color ? 'selected' : '' }}>
                                            {{ ucfirst($color) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" class="filter-button">Apply Filters</button>
                        </div>
                    </form>
                </div>
                
                <!-- Products Grid -->
                <div class="products-grid">
                    <div class="products-header">
                        <div class="products-count">{{ $products->total() }} products found</div>
                        <div class="sort-options">
                            <form action="{{ route('products.index') }}" method="GET" id="sort-form">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                @if(request('designer'))
                                    <input type="hidden" name="designer" value="{{ request('designer') }}">
                                @endif
                                @if(request('min_price'))
                                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                                @endif
                                @if(request('max_price'))
                                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                                @endif
                                @if(request('color'))
                                    <input type="hidden" name="color" value="{{ request('color') }}">
                                @endif
                                
                                <select name="sort" onchange="document.getElementById('sort-form').submit()">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="popularity" {{ request('sort') == 'popularity' ? 'selected' : '' }}>Best Selling</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    
                    <div class="products-list">
                        @forelse($products as $product)
                            <div class="product-card">
                                <div class="product-image">
                                    @if($product->hasDiscount())
                                        <div class="product-badge">Sale</div>
                                    @endif
                                    
                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/280/280' }}" alt="{{ $product->name }}">
                                    
                                    <div class="product-actions">
                                        <a href="{{ route('products.show', $product->id) }}" title="View Details"><i class="fas fa-eye"></i></a>
                                        
                                        <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="size" value="M">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                                        </form>
                                        
                                        @auth
                                            <form action="{{ route('favorites.toggle') }}" method="POST" class="favorite-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="favorite-btn {{ auth()->user()->hasFavorited($product->id) ? 'favorited' : '' }}" 
                                                        title="{{ auth()->user()->hasFavorited($product->id) ? 'Remove from Favorites' : 'Add to Favorites' }}">
                                                    <i class="fas fa-heart"></i>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}" title="Add to Favorites"><i class="fas fa-heart"></i></a>
                                        @endauth
                                    </div>
                                </div>
                                
                                <div class="product-info">
                                    <h3 class="product-name">{{ $product->name }}</h3>
                                    Design by: {{ $product->designer ? $product->designer->name : 'Unknown' }}
                                    <div class="product-price">
                                        @if($product->hasDiscount())
                                            <span class="original-price">${{ number_format($product->price, 2) }}</span>
                                            <span class="discount-price">${{ number_format($product->discounted_price, 2) }}</span>
                                        @else
                                            ${{ number_format($product->price, 2) }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="no-products">
                                <i class="fas fa-search"></i>
                                <h3>No products found</h3>
                                <p>Try changing your filters or check back later for new arrivals.</p>
                                <a href="{{ route('products.index') }}" class="btn btn-primary">View All Products</a>
                            </div>
                        @endforelse
                    </div>
                    
                    <!-- Pagination -->
                    <div class="pagination">
                        <ul class="pagination-list">
                            @if ($products->onFirstPage())
                                <li class="pagination-item">
                                    <span style="display: flex; width: 45px; height: 45px; justify-content: center; align-items: center; border-radius: 10px; color: #ccc; border: 2px solid #e1e8ed; background: #fff;">
                                        <i class="fas fa-chevron-left"></i>
                                    </span>
                                </li>
                            @else
                                <li class="pagination-item">
                                    <a href="{{ $products->previousPageUrl() }}" style="display: flex; width: 45px; height: 45px; justify-content: center; align-items: center; border-radius: 10px; color: #2c3e50; text-decoration: none; transition: all 0.3s ease; border: 2px solid #e1e8ed; background: #fff; font-weight: 500;">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                </li>
                            @endif
                            
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                <li class="pagination-item">
                                    <a href="{{ $url }}" class="pagination-link {{ $page == $products->currentPage() ? 'active' : '' }}" style="display: flex; width: 45px; height: 45px; justify-content: center; align-items: center; border-radius: 10px; color: #2c3e50; text-decoration: none; transition: all 0.3s ease; border: 2px solid #e1e8ed; background: #fff; font-weight: 500;">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endforeach
                            
                            @if ($products->hasMorePages())
                                <li class="pagination-item">
                                    <a href="{{ $products->nextPageUrl() }}" style="display: flex; width: 45px; height: 45px; justify-content: center; align-items: center; border-radius: 10px; color: #2c3e50; text-decoration: none; transition: all 0.3s ease; border: 2px solid #e1e8ed; background: #fff; font-weight: 500;">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="pagination-item">
                                    <span style="display: flex; width: 45px; height: 45px; justify-content: center; align-items: center; border-radius: 10px; color: #ccc; border: 2px solid #e1e8ed; background: #fff;">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <a href="{{ route('landing') }}" class="logo" style="color: #fff; font-size: 32px; font-weight: 300; text-decoration: none; letter-spacing: 1px;">Ele<span style="font-weight: 700; background: linear-gradient(45deg, #ff6b9d, #c44569); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">gance</span></a>
                    <p>A platform connecting distinguished fashion designers with customers seeking uniqueness, offering piece customization and learning through outstanding fashion design courses.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
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
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <div class="footer-links">
                        <div style="display: flex; align-items: center; margin-bottom: 15px;">
                            <i class="fas fa-map-marker-alt" style="margin-right: 15px; color: #ff6b9d;"></i>
                            <span>123 Fashion Street, Amman, Jordan</span>
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
                            <input type="email" name="email" placeholder="Join our newsletter" required>
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

            // For color selection functionality
            document.querySelectorAll('.color-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.color-option').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('selected-color').value = this.dataset.color;
                });
            });

            // Function to show toast notification
            function showToast(message, type = 'success') {
                const toast = document.getElementById('toastNotification');
                toast.textContent = message;
                toast.className = `toast show ${type}`;
                
                setTimeout(() => {
                    toast.className = 'toast';
                }, 3000);
            }

            // Function to show loading spinner
            function showLoading(show) {
                const spinner = document.getElementById('loadingSpinner');
                spinner.className = show ? 'loading-spinner active' : 'loading-spinner';
            }

            // AJAX functionality for favorite toggle
            const favoritesForms = document.querySelectorAll('.favorite-form');
            
            favoritesForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const button = this.querySelector('.favorite-btn');
                    const productId = formData.get('product_id');
                    
                    showLoading(true);
                    
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
                        showLoading(false);
                        
                        if (data.status === 'success') {
                            // Toggle the button appearance
                            button.classList.toggle('favorited');
                            
                            // Update tooltip/title
                            if (button.classList.contains('favorited')) {
                                button.setAttribute('title', 'Remove from Favorites');
                                showToast('Product added to favorites!');
                                
                                // Update favorites count in header
                                const favoritesCount = document.querySelector('.favorites-counter');
                                if (favoritesCount) {
                                    favoritesCount.textContent = parseInt(favoritesCount.textContent) + 1;
                                } else {
                                    const favoritesLink = document.querySelector('.favorites-link');
                                    const newCount = document.createElement('span');
                                    newCount.className = 'counter favorites-counter';
                                    newCount.textContent = '1';
                                    favoritesLink.appendChild(newCount);
                                }
                                
                                // Redirect to favorites page after 1 second
                                setTimeout(() => {
                                    window.location.href = "{{ route('favorites.index') }}";
                                }, 1000);
                            } else {
                                button.setAttribute('title', 'Add to Favorites');
                                showToast('Product removed from favorites!');
                                
                                // Update favorites count in header
                                const favoritesCount = document.querySelector('.favorites-counter');
                                if (favoritesCount) {
                                    const newCount = parseInt(favoritesCount.textContent) - 1;
                                    if (newCount > 0) {
                                        favoritesCount.textContent = newCount;
                                    } else {
                                        favoritesCount.remove();
                                    }
                                }
                            }
                        } else {
                            showToast(data.message || 'An error occurred', 'error');
                        }
                    })
                    .catch(error => {
                        showLoading(false);
                        showToast('An error occurred. Please try again.', 'error');
                        console.error('Error:', error);
                    });
                });
            });

            // AJAX functionality for add to cart
            const addToCartForms = document.querySelectorAll('.add-to-cart-form');
            
            addToCartForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const button = this.querySelector('button');
                    
                    showLoading(true);
                    
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
                        showLoading(false);
                        
                        if (data.status === 'success') {
                            showToast('Product added to cart!');
                            
                            // Update cart counter in header
                            const cartCounter = document.querySelector('.cart-counter');
                            if (cartCounter) {
                                cartCounter.textContent = parseInt(cartCounter.textContent) + 1;
                            } else {
                                const cartIcon = document.querySelector('.icon-btn[title="Cart"]');
                                if (cartIcon) {
                                    const newCounter = document.createElement('span');
                                    newCounter.className = 'counter cart-counter';
                                    newCounter.textContent = '1';
                                    cartIcon.appendChild(newCounter);
                                }
                            }
                        } else {
                            showToast(data.message || 'An error occurred', 'error');
                        }
                    })
                    .catch(error => {
                        showLoading(false);
                        showToast('An error occurred. Please try again.', 'error');
                        console.error('Error:', error);
                    });
                });
            });

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
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(card);
            });
        });
    </script>
</body>
</html>