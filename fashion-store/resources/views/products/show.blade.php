<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} - {{ config('app.name') }}</title>
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
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 80px 0;
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
        
        .breadcrumb {
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            font-size: 14px;
        }
        
        .breadcrumb a {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .breadcrumb a:hover {
            color: #ffd1dc;
        }
        
        .breadcrumb .separator {
            margin: 0 10px;
            color: #ccc;
        }
        
        .breadcrumb .current {
            color: #333;
            font-weight: 500;
        }
        
        .product-detail {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 60px;
        }
        
        .product-detail-content {
            display: flex;
            flex-wrap: wrap;
        }
        
        .product-gallery {
            width: 55%;
            padding: 30px;
        }
        
        .main-image {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .thumbnails {
            display: flex;
            gap: 15px;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .thumbnail.active {
            border-color: #ffd1dc;
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-info {
            width: 45%;
            padding: 30px;
            display: flex;
            flex-direction: column;
        }
        
        .product-name {
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 10px;
            line-height: 1.2;
        }
        
        .product-designer {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .designer-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .designer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .designer-name {
            font-size: 16px;
            color: #666;
        }
        
        .designer-name a {
            color: #333;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .designer-name a:hover {
            color: #ffd1dc;
        }
        
        .product-price {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 15px;
            font-size: 20px;
            font-weight: normal;
        }
        
        .discount-price {
            color: #ff5b79;
        }
        
        .product-description {
            margin-bottom: 30px;
            line-height: 1.8;
            color: #666;
        }
        
        .product-options {
            margin-bottom: 30px;
        }
        
        .option-group {
            margin-bottom: 20px;
        }
        
        .option-label {
            display: block;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .size-options {
            display: flex;
            gap: 10px;
        }
        
        .size-option {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .size-option.active {
            background-color: #000;
            color: white;
            border-color: #000;
        }
        
        .size-option.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .quantity-input {
            display: flex;
            align-items: center;
            width: fit-content;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            background-color: #f5f5f5;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        .quantity-btn:hover {
            background-color: #eee;
        }
        
        .quantity-input input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: none;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: auto;
        }
        
        .btn {
            padding: 14px 25px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .btn i {
            margin-right: 10px;
        }
        
        .btn-primary {
            background-color: #000;
            color: white;
            border: 1px solid #000;
            flex: 1;
        }
        
        .btn-primary:hover {
            background-color: #333;
        }
        
        .btn-outline {
            background-color: transparent;
            color: #000;
            border: 1px solid #000;
        }
        
        .btn-outline:hover {
            background-color: #f5f5f5;
        }
        
        .product-meta {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            color: #666;
            font-size: 14px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
        }
        
        .meta-item i {
            margin-right: 8px;
        }
        
        .product-tabs {
            margin-bottom: 60px;
        }
        
        .tabs-navigation {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 30px;
        }
        
        .tab-button {
            padding: 15px 25px;
            font-size: 16px;
            font-weight: 500;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .tab-button.active {
            border-bottom-color: #ffd1dc;
            color: #000;
        }
        
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        .tab-content.active {
            display: block;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .reviews-list {
            margin-bottom: 30px;
        }
        
        .review-card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .reviewer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .reviewer-info {
            flex: 1;
        }
        
        .reviewer-name {
            font-weight: 500;
            margin-bottom: 3px;
        }
        
        .review-date {
            font-size: 12px;
            color: #999;
        }
        
        .review-rating {
            color: #ffc107;
            font-size: 14px;
        }
        
        .review-content {
            line-height: 1.7;
        }
        
        .review-form {
            background-color: #f5f5f5;
            border-radius: 8px;
            padding: 25px;
        }
        
        .review-form h3 {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 500;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .rating-input {
            display: flex;
            flex-direction: row-reverse;
            font-size: 24px;
        }
        
        .rating-input input {
            display: none;
        }
        
        .rating-input label {
            cursor: pointer;
            color: #ddd;
            transition: all 0.2s ease;
            margin: 0 2px;
        }
        
        .rating-input label:hover,
        .rating-input label:hover ~ label,
        .rating-input input:checked ~ label {
            color: #ffc107;
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
            font-size: 15px;
        }
        
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        
        .related-products {
            margin-bottom: 60px;
        }
        
        .section-title {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 30px;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 2px;
            background-color: #ffd1dc;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .related-products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .product-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .product-card:hover {
            transform: translateY(-10px);
        }
        
        .product-card-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .product-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-card-image img {
            transform: scale(1.05);
        }
        
        .product-card-info {
            padding: 15px;
        }
        
        .product-card-name {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .product-card-designer {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .product-card-price {
            font-weight: 700;
        }

        /* New styles for the modifications */
        .color-option {
            transition: all 0.3s ease;
            position: relative;
        }

        .color-option.active {
            box-shadow: 0 0 0 2px white, 0 0 0 4px #ffd1dc;
        }

        .color-option.active:after {
            content: '\2713';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            text-shadow: 0 0 2px rgba(0,0,0,0.5);
        }

        .error-message {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% {transform: translateX(0);}
            20%, 60% {transform: translateX(-5px);}
            40%, 80% {transform: translateX(5px);}
        }

        #addToCartBtn.disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn.disabled {
            pointer-events: none;
        }

        /* Confirmation modal styles */
        #confirmationModal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        #confirmationModal > div {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        @media (max-width: 992px) {
            .product-gallery, .product-info {
                width: 100%;
            }
            
            .main-image {
                height: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .tabs-navigation {
                flex-wrap: wrap;
            }
            
            .tab-button {
                padding: 10px 15px;
                font-size: 14px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
            
            .product-name {
                font-size: 24px;
            }
            
            .product-price {
                font-size: 20px;
            }
            
            .original-price {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="{{ route('landing') }}" class="logo">Ele<span>gance</span></a>
            <nav>
                <ul>
                    <li><a href="{{ route('landing') }}">Home</a></li>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('designers.index') }}">Designers</a></li>
                    <li><a href="{{ route('courses.index') }}">Courses</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('landing') }}">Home</a>
            <span class="separator"><i class="fas fa-chevron-right"></i></span>
            <a href="{{ route('products.index') }}">Products</a>
            <span class="separator"><i class="fas fa-chevron-right"></i></span>
            <span class="current">{{ $product->name }}</span>
        </div>

        <!-- Product Detail -->
        <div class="product-detail">
            <div class="product-detail-content">
                <!-- Product Gallery -->
                <div class="product-gallery">
                    <div class="main-image">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/500/500' }}" alt="{{ $product->name }}" id="main-product-image">
                    </div>
                    <div class="thumbnails">
                        <div class="thumbnail active" data-image="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/500/500' }}">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/80/80' }}" alt="{{ $product->name }}">
                        </div>
                        <!-- Placeholder thumbnails (in a real app, these would be additional product images) -->
                        <div class="thumbnail" data-image="/api/placeholder/500/500?text=Image+2">
                            <img src="/api/placeholder/80/80?text=2" alt="Product view 2">
                        </div>
                        <div class="thumbnail" data-image="/api/placeholder/500/500?text=Image+3">
                            <img src="/api/placeholder/80/80?text=3" alt="Product view 3">
                        </div>
                        <div class="thumbnail" data-image="/api/placeholder/500/500?text=Image+4">
                            <img src="/api/placeholder/80/80?text=4" alt="Product view 4">
                        </div>
                    </div>
                </div>
                
                <!-- Product Info -->
                <div class="product-info">
                    <h1 class="product-name">{{ $product->name }}</h1>
                    
                    <div class="product-designer">
                        <div class="designer-avatar">
                            <img src="{{ $product->designer->profile_picture ? asset('storage/'.$product->designer->profile_picture) : '/api/placeholder/40/40' }}" alt="{{ $product->designer->name }}">
                        </div>
                        <div class="designer-name">
                            Designed by <a href="{{ route('designers.show', $product->designer->id) }}">{{ $product->designer->name }}</a>
                        </div>
                    </div>
                    
                    <div class="product-price">
                        @if($product->hasDiscount())
                            <span class="original-price">${{ number_format($product->price, 2) }}</span>
                            <span class="discount-price">${{ number_format($product->discounted_price, 2) }}</span>
                        @else
                            ${{ number_format($product->price, 2) }}
                        @endif
                    </div>
                    
                    <div class="product-description">
                        {{ $product->description }}
                    </div>
                    
                    <!-- Modified Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="product-options">
                            <div class="option-group">
                                <label class="option-label">Size:</label>
                                <div class="size-options">
                                    @foreach($product->sizes as $sizeOption)
                                        <div class="size-option {{ $loop->first ? 'active' : '' }} {{ $sizeOption->stock_quantity <= 0 ? 'disabled' : '' }}" 
                                             data-size="{{ $sizeOption->size }}">
                                            {{ $sizeOption->size }}
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="size" value="{{ $product->sizes->first()->size ?? 'M' }}" id="selected-size">
                                <div class="error-message" id="size-error" style="display: none; color: #ff5b79; font-size: 12px; margin-top: 5px;">Please select a size</div>
                            </div>
                            
                            <div class="option-group">
                                <label class="option-label">Color:</label>
                                <div class="color-options" style="display: flex; gap: 10px; margin-bottom: 15px;">
                                    <div class="color-option active" data-color="{{ $product->color }}" style="width: 30px; height: 30px; border-radius: 50%; background-color: {{ $product->color }}; cursor: pointer; border: 2px solid #000;"></div>
                                    <!-- يمكن إضافة ألوان إضافية هنا في حالة توفرها -->
                                </div>
                                <input type="hidden" name="color" value="{{ $product->color }}" id="selected-color">
                            </div>
                            
                            <div class="option-group">
                                <label class="option-label">Quantity:</label>
                                <div class="quantity-input">
                                    <button type="button" class="quantity-btn" id="decrease-qty">-</button>
                                    <input type="number" name="quantity" value="1" min="1" max="10" id="quantity-input">
                                    <button type="button" class="quantity-btn" id="increase-qty">+</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <button type="button" id="addToCartBtn" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            
                            @auth
                                <form action="{{ route('favorites.toggle') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline">
                                        <i class="fas fa-heart {{ auth()->user()->hasFavorited($product->id) ? 'text-danger' : '' }}"></i> 
                                        {{ auth()->user()->hasFavorited($product->id) ? 'Remove from Favorites' : 'Add to Favorites' }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline">
                                    <i class="fas fa-heart"></i> Add to Favorites
                                </a>
                            @endauth
                        </div>
                    </form>
                    
                    <!-- Confirmation Modal -->
                    <div id="confirmationModal" style="display: none;">
                        <div>
                            <i class="fas fa-check-circle" style="font-size: 60px; color: #4CAF50; margin-bottom: 20px;"></i>
                            <h3 style="margin-bottom: 15px;">Added to Cart!</h3>
                            <p style="margin-bottom: 25px;">The item has been added to your shopping cart.</p>
                            <div style="display: flex; gap: 15px; justify-content: center;">
                                <button id="continueShoppingBtn" class="btn btn-outline" style="min-width: 120px;">Continue Shopping</button>
                                <a href="{{ route('cart.index') }}" class="btn btn-primary" style="min-width: 120px;">View Cart</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="product-meta">
                        <div class="meta-item">
                            <i class="fas fa-tag"></i> Category: {{ $product->category }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-palette"></i> Color: {{ ucfirst($product->color) }}
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-box"></i> SKU: PROD-{{ $product->id }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Tabs -->
        <div class="product-tabs">
            <div class="tabs-navigation">
                <button class="tab-button active" data-tab="details">Product Details</button>
                <button class="tab-button" data-tab="shipping">Shipping & Returns</button>
                <button class="tab-button" data-tab="reviews">Customer Reviews ({{ $product->ratings->count() }})</button>
            </div>
            
            <!-- Tab Contents -->
            <div class="tab-content active" id="details-tab">
                <p>{{ $product->description }}</p>
                <ul style="margin-top: 20px; padding-left: 20px;">
                    <li><strong>Material:</strong> Premium quality fabric</li>
                    <li><strong>Color:</strong> {{ ucfirst($product->color) }}</li>
                    <li><strong>Style:</strong> Contemporary</li>
                    <li><strong>Care Instructions:</strong> Hand wash or gentle machine wash</li>
                </ul>
            </div>
            
            <div class="tab-content" id="shipping-tab">
                <h3 style="margin-bottom: 15px;">Shipping Information</h3>
                <p>We offer worldwide shipping on all orders. Shipping times may vary depending on your location:</p>
                <ul style="margin: 15px 0; padding-left: 20px;">
                    <li>Domestic: 1-3 business days</li>
                    <li>International: 7-14 business days</li>
                </ul>
                
                <h3 style="margin: 25px 0 15px;">Return Policy</h3>
                <p>We want you to be completely satisfied with your purchase. If for any reason you're not happy with your order, you can return it within 30 days of delivery for a full refund or exchange.</p>
                <p style="margin-top: 15px;">Please note that returned items must be unworn, unwashed, and in their original packaging with all tags attached.</p>
            </div>
            
            <div class="tab-content" id="reviews-tab">
                <div class="reviews-list">
                    @forelse($product->ratings as $rating)
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-avatar">
                                    <img src="/api/placeholder/50/50" alt="{{ $rating->user->name }}">
                                </div>
                                <div class="reviewer-info">
                                    <div class="reviewer-name">{{ $rating->user->name }}</div>
                                    <div class="review-date">{{ $rating->created_at->format('F d, Y') }}</div>
                                </div>
                                <div class="review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="review-content">
                                {{ $rating->review }}
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; padding: 30px;">
                            <i class="far fa-comment-dots" style="font-size: 48px; color: #ddd; margin-bottom: 15px;"></i>
                            <h3>No reviews yet</h3>
                            <p>Be the first to review this product</p>
                        </div>
                    @endforelse
                </div>
                
                @auth
                    <div class="review-form">
                        <h3>Leave a Review</h3>
                        <form action="{{ route('ratings.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="form-group">
                                <label>Your Rating</label>
                                <div class="rating-input">
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" required>
                                        <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                                    @endfor
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="review">Your Review</label>
                                <textarea class="form-control" id="review" name="review" required minlength="10" placeholder="Share your experience with this product..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                @else
                    <div style="text-align: center; padding: 30px; background-color: #f5f5f5; border-radius: 8px;">
                        <p>Please <a href="{{ route('login') }}" style="color: #000; text-decoration: underline;">log in</a> to leave a review.</p>
                    </div>
                @endauth
            </div>
        </div>
        
        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="related-products">
                <h2 class="section-title">You May Also Like</h2>
                <div class="related-products-grid">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="product-card">
                            <div class="product-card-image">
                                <img src="{{ $relatedProduct->image ? asset('storage/'.$relatedProduct->image) : '/api/placeholder/250/200' }}" alt="{{ $relatedProduct->name }}">
                            </div>
                            <div class="product-card-info">
                                <h3 class="product-card-name">{{ $relatedProduct->name }}</h3>
                                <p class="product-card-designer">by {{ $relatedProduct->designer->name }}</p>
                                <div class="product-card-price">
                                    @if($relatedProduct->hasDiscount())
                                        <span class="original-price">${{ number_format($relatedProduct->price, 2) }}</span>
                                        <span class="discount-price">${{ number_format($relatedProduct->discounted_price, 2) }}</span>
                                    @else
                                        ${{ number_format($relatedProduct->price, 2) }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // الحصول على العناصر من DOM
            const addToCartBtn = document.getElementById('addToCartBtn');
            const addToCartForm = document.getElementById('addToCartForm');
            const confirmationModal = document.getElementById('confirmationModal');
            const continueShoppingBtn = document.getElementById('continueShoppingBtn');
            const sizeError = document.getElementById('size-error');
            
            // التعامل مع نقرة زر الإضافة إلى السلة
            addToCartBtn.addEventListener('click', function() {
                // التحقق من اختيار الحجم
                const selectedSize = document.getElementById('selected-size').value;
                if (!selectedSize) {
                    sizeError.style.display = 'block';
                    return;
                }
                
                // إخفاء رسالة الخطأ إذا تم اختيار الحجم
                sizeError.style.display = 'none';
                
                // تغيير نص الزر
                addToCartBtn.innerHTML = '<i class="fas fa-check"></i> Added';
                addToCartBtn.disabled = true;
                
                // إرسال النموذج باستخدام AJAX
                const formData = new FormData(addToCartForm);
                
                fetch(addToCartForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // عرض نافذة التأكيد
                        confirmationModal.style.display = 'flex';
                        
                        // تحديث عدد عناصر السلة في الهيدر (إذا كان موجودًا)
                        const cartCount = document.getElementById('cartCount');
                        if (cartCount) {
                            cartCount.textContent = data.cartCount;
                            cartCount.style.display = 'inline-block';
                        }
                    } else {
                        // في حالة وجود خطأ
                        alert(data.message || 'حدث خطأ أثناء إضافة المنتج إلى السلة.');
                        addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                        addToCartBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('حدث خطأ أثناء إضافة المنتج إلى السلة.');
                    addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                    addToCartBtn.disabled = false;
                });
            });
            
            // التعامل مع زر "مواصلة التسوق"
            continueShoppingBtn.addEventListener('click', function() {
                confirmationModal.style.display = 'none';
                addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
                addToCartBtn.disabled = false;
            });
            
            // اختيار الحجم
            document.querySelectorAll('.size-option:not(.disabled)').forEach(sizeOption => {
                sizeOption.addEventListener('click', function() {
                    document.querySelectorAll('.size-option').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('selected-size').value = this.dataset.size;
                    sizeError.style.display = 'none';
                });
            });
            
            // اختيار اللون
            document.querySelectorAll('.color-option').forEach(colorOption => {
                colorOption.addEventListener('click', function() {
                    document.querySelectorAll('.color-option').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementById('selected-color').value = this.dataset.color;
                });
            });

            // Thumbnail gallery functionality
            document.querySelectorAll('.thumbnail').forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Update active state
                    document.querySelectorAll('.thumbnail').forEach(el => el.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update main image
                    document.getElementById('main-product-image').src = this.dataset.image;
                });
            });
            
            // Quantity input
            const quantityInput = document.getElementById('quantity-input');
            document.getElementById('decrease-qty').addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });
            
            document.getElementById('increase-qty').addEventListener('click', function() {
                const currentValue = parseInt(quantityInput.value);
                if (currentValue < 10) {
                    quantityInput.value = currentValue + 1;
                }
            });
            
            // Tabs functionality
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    // Update active tab button
                    document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update active tab content
                    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
                    document.getElementById(this.dataset.tab + '-tab').classList.add('active');
                });
            });
        });
    </script>
</body>
</html>