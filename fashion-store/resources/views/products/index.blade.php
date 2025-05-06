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
        
        .page-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .page-title h1 {
            font-size: 36px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }
        
        .page-title p {
            font-size: 16px;
            color: #666;
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
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .filter-card h3 {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .filter-group {
            margin-bottom: 20px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 15px;
        }
        
        .filter-group select,
        .filter-group input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
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
        }
        
        .color-option.active {
            border-color: #000;
        }
        
        .filter-button {
            width: 100%;
            background-color: #000;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .filter-button:hover {
            background-color: #333;
        }
        
        .products-grid {
            flex: 1;
        }
        
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .products-count {
            font-size: 14px;
            color: #666;
        }
        
        .sort-options select {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .products-list {
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
        
        .product-image {
            position: relative;
            height: 250px;
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
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .product-actions a:hover,
        .product-actions button:hover {
            background-color: #ffd1dc;
            color: #333;
        }
        
        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 5px 10px;
            background-color: #ffd1dc;
            color: #333;
            font-size: 12px;
            border-radius: 4px;
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
            display: flex;
            align-items: center;
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
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 50px;
            gap: 10px;
        }
        
        .pagination a {
            display: flex;
            width: 40px;
            height: 40px;
            justify-content: center;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .pagination a:hover,
        .pagination a.active {
            background-color: #ffd1dc;
            border-color: #ffd1dc;
            color: #333;
        }
        
        @media (max-width: 992px) {
            .products-container {
                flex-direction: column;
            }
            
            .filter-sidebar {
                width: 100%;
                margin-bottom: 30px;
            }
        }
        
        @media (max-width: 768px) {
            .products-list {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
            
            .products-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .page-title h1 {
                font-size: 28px;
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
        <div class="page-title">
            <h1>Fashion Products</h1>
            <p>Explore our exclusive collection of designer fashion</p>
        </div>

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
                                
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : '/api/placeholder/250/250' }}" alt="{{ $product->name }}">
                                
                                <div class="product-actions">
                                    <a href="{{ route('products.show', $product->id) }}" title="View Details"><i class="fas fa-eye"></i></a>
                                    
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="size" value="M">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" title="Add to Cart"><i class="fas fa-shopping-cart"></i></button>
                                    </form>
                                    
                                    @auth
                                        <form action="{{ route('favorites.toggle') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" title="Add to Favorites">
                                                <i class="fas fa-heart {{ auth()->user()->hasFavorited($product->id) ? 'text-danger' : '' }}"></i>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" title="Add to Favorites"><i class="fas fa-heart"></i></a>
                                    @endauth
                                </div>
                            </div>
                            
                            <div class="product-info">
                                <h3 class="product-name">{{ $product->name }}</h3>
                                <p class="product-designer">Design by: {{ $product->designer->name }}</p>
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
                        <div class="no-products" style="grid-column: 1 / -1; text-align: center; padding: 50px 0;">
                            <i class="fas fa-search" style="font-size: 48px; color: #ddd; margin-bottom: 20px;"></i>
                            <h3>No products found</h3>
                            <p>Try changing your filters or check back later for new arrivals.</p>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="pagination">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        // For color selection functionality
        document.querySelectorAll('.color-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.color-option').forEach(el => el.classList.remove('active'));
                this.classList.add('active');
                document.getElementById('selected-color').value = this.dataset.color;
            });
        });
    </script>
</body>
</html>