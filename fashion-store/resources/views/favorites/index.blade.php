<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('My Favorites') }} - {{ config('app.name', 'Elegance') }}</title>
    <link href="https://fonts.googleapis.com/css2?family={{ app()->getLocale() == 'ar' ? 'Tajawal' : 'Poppins' }}:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['{{ app()->getLocale() == "ar" ? "Tajawal" : "Poppins" }}', 'sans-serif'],
                    },
                    colors: {
                        'elegance-pink': '#ff6b9d',
                        'elegance-purple': '#c44569',
                        'elegance-dark': '#2c3e50',
                        'elegance-light': '#f8f9fa',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .gradient-text {
            background: linear-gradient(45deg, #ff6b9d, #c44569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-elegance-light text-elegance-dark font-sans">
    <!-- Header -->
    <header class="fixed w-full z-50 bg-white/95 backdrop-blur-sm shadow-lg transition-all duration-300" id="header">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="{{ route('landing') }}" class="text-3xl font-light text-elegance-dark tracking-wide">
                    Ele<span class="font-bold gradient-text">gance</span>
                </a>
                
                <!-- Navigation -->
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="{{ route('landing') }}" class="nav-link">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('products.index') }}" class="nav-link">{{ __('Products') }}</a></li>
                        <li><a href="{{ route('designers.index') }}" class="nav-link">{{ __('Designers') }}</a></li>
                        <li><a href="{{ route('courses.index') }}" class="nav-link">{{ __('Courses') }}</a></li>
                        <li><a href="{{ route('about') }}" class="nav-link">{{ __('About') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="nav-link">{{ __('Contact') }}</a></li>
                    </ul>
                </nav>
                
                <!-- Header Icons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('favorites.index') }}" class="relative p-2 text-elegance-dark hover:text-elegance-pink transition-colors duration-300 rounded-full hover:bg-elegance-pink/10">
                        <i class="fas fa-heart text-xl"></i>
                        @auth
                            @if(auth()->user()->favorites()->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-gradient-to-r from-elegance-pink to-elegance-purple text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-semibold">
                                    {{ auth()->user()->favorites()->count() }}
                                </span>
                            @endif
                        @endauth
                    </a>
                    
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-elegance-dark hover:text-elegance-pink transition-colors duration-300 rounded-full hover:bg-elegance-pink/10">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        @if(session()->has('cart') && !empty(session('cart')))
                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-elegance-pink to-elegance-purple text-white text-xs w-5 h-5 rounded-full flex items-center justify-center font-semibold">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                    
                    <!-- CTA Buttons -->
                    <div class="hidden lg:flex space-x-3">
                        @auth
                            @if(auth()->user()->role === 'designer' || auth()->user()->is_designer)
                                <a href="{{ route('designer.dashboard') }}" class="px-6 py-2 border-2 border-elegance-dark text-elegance-dark rounded-lg hover:bg-elegance-dark hover:text-white transition-all duration-300 font-semibold">
                                    {{ __('Designer Dashboard') }}
                                </a>
                            @elseif(in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 border-2 border-elegance-dark text-elegance-dark rounded-lg hover:bg-elegance-dark hover:text-white transition-all duration-300 font-semibold">
                                    {{ __('Admin Dashboard') }}
                                </a>
                            @else
                                <!-- User Menu -->
                                <div class="user-menu relative inline-block">
                                    <button class="px-6 py-2 border-2 border-elegance-dark text-elegance-dark rounded-lg hover:bg-elegance-dark hover:text-white transition-all duration-300 font-semibold user-menu-toggle flex items-center gap-2 min-w-40 justify-between" onclick="toggleUserMenu()">
                                        <i class="fas fa-user"></i>
                                        {{ auth()->user()->name }}
                                        <i class="fas fa-chevron-down text-sm transition-transform duration-300"></i>
                                    </button>
                                    <div class="user-dropdown absolute top-full right-0 mt-2 bg-white/95 backdrop-blur-sm rounded-xl shadow-xl border border-gray-200 min-w-48 z-50 opacity-0 invisible transform -translate-y-2 transition-all duration-300" id="userDropdown">
                                        <a href="{{ route('profile.edit') }}" class="dropdown-item flex items-center gap-3 px-4 py-3 text-elegance-dark hover:bg-elegance-pink/10 hover:text-elegance-pink transition-all duration-300 first:rounded-t-xl">
                                            <i class="fas fa-user-edit"></i>
                                            {{ __('Profile') }}
                                        </a>
                                        
                                        <a href="{{ route('favorites.index') }}" class="dropdown-item flex items-center gap-3 px-4 py-3 text-elegance-dark hover:bg-elegance-pink/10 hover:text-elegance-pink transition-all duration-300">
                                            <i class="fas fa-heart"></i>
                                            {{ __('Favorites') }}
                                        </a>
                                        <div class="border-t border-gray-200 my-1"></div>
                                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                                            @csrf
                                            <button type="submit" class="dropdown-item w-full text-left flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 hover:text-red-600 transition-all duration-300 last:rounded-b-xl">
                                                <i class="fas fa-sign-out-alt"></i>
                                                {{ __('Logout') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2 border-2 border-elegance-dark text-elegance-dark rounded-lg hover:bg-elegance-dark hover:text-white transition-all duration-300 font-semibold">
                                {{ __('Sign In') }}
                            </a>
                            <a href="{{ route('register') }}" class="px-6 py-2 bg-gradient-to-r from-elegance-pink to-elegance-purple text-white rounded-lg hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                                {{ __('Create Account') }}
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-elegance-dark text-2xl" id="mobile-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Header -->
    <div class="pt-24 pb-16 bg-gradient-to-br from-elegance-pink/5 to-elegance-purple/5">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-light mb-6 relative inline-block">
                {{ __('My Favorites') }}
                <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 w-20 h-1 bg-gradient-to-r from-elegance-pink to-elegance-purple rounded"></div>
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                {{ __('Your collection of favorite designs from our talented designers') }}
            </p>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="fixed bottom-5 right-5 z-50 transform translate-y-24 opacity-0 transition-all duration-300" id="toast">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg">
            <span id="toast-message"></span>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <!-- Filter Section -->
        <div class="glass-effect rounded-2xl p-8 mb-12 shadow-xl">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
                <!-- Search Box -->
                <div class="relative w-full max-w-md">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-full focus:border-elegance-pink focus:outline-none focus:ring-4 focus:ring-elegance-pink/20 transition-all duration-300" 
                           placeholder="{{ __('Search your favorites...') }}" 
                           id="search-favorites">
                </div>
                
                <!-- Filter Dropdowns -->
                <div class="flex flex-wrap gap-4">
                    <select class="px-6 py-4 border-2 border-gray-200 rounded-full focus:border-elegance-pink focus:outline-none focus:ring-4 focus:ring-elegance-pink/20 transition-all duration-300 min-w-40" id="filter-designer">
                        <option value="">{{ __('All Designers') }}</option>
                        @foreach($favorites->pluck('product.designer')->unique('id')->filter() as $designer)
                            <option value="{{ $designer->id }}">{{ $designer->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Results Info -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
            <div class="text-gray-600">
                {{ __('Showing :count of :total favorites', [
                    'count' => count($favorites),
                    'total' => count($favorites)
                ]) }}
            </div>
            <div class="flex gap-2">
                <button class="w-10 h-10 border-2 border-gray-200 bg-white rounded-lg flex items-center justify-center hover:border-elegance-pink hover:bg-elegance-pink hover:text-white transition-all duration-300 view-btn active" data-view="grid">
                    <i class="fas fa-th"></i>
                </button>
                <button class="w-10 h-10 border-2 border-gray-200 bg-white rounded-lg flex items-center justify-center hover:border-elegance-pink hover:bg-elegance-pink hover:text-white transition-all duration-300 view-btn" data-view="list">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        <!-- Favorites Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16" id="favorites-container">
            @if(count($favorites) > 0)
                @foreach($favorites as $favorite)
                <div class="glass-effect rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-4 transition-all duration-500 group animate-slide-up" 
                     id="favorite-{{ $favorite->product->id }}" 
                     data-designer-id="{{ optional($favorite->product->designer)->id }}" 
                     data-name="{{ $favorite->product->name }}" 
                     data-price="{{ $favorite->product->price }}" 
                     data-date="{{ $favorite->created_at->timestamp }}">
                    
                    <!-- Product Image -->
                    <div class="relative h-72 overflow-hidden">
                        <img src="{{ $favorite->product->image_url ?? '/api/placeholder/400/280?text=Product+Image' }}" 
                             alt="{{ $favorite->product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        
                        @if($favorite->product->discount && $favorite->product->discount->percentage > 0)
                            <div class="absolute top-4 left-4 bg-gradient-to-r from-elegance-pink to-elegance-purple text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ __('Sale') }}
                            </div>
                        @endif
                        
                        <!-- Product Actions -->
                        <div class="absolute top-4 right-4 flex flex-col gap-3 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                            <button class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 remove-favorite" 
                                    data-id="{{ $favorite->product->id }}" 
                                    data-url="{{ route('favorites.toggle') }}">
                                <i class="fas fa-heart"></i>
                            </button>
                            <a href="{{ route('products.show', $favorite->product->id) }}" 
                               class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-elegance-dark hover:bg-elegance-pink hover:text-white transition-all duration-300">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('favorites.add-all-to-cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $favorite->product->id }}">
                                <input type="hidden" name="size" value="M">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-elegance-dark hover:bg-elegance-pink hover:text-white transition-all duration-300">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2 text-elegance-dark">{{ $favorite->product->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ __('by') }} {{ optional($favorite->product->designer)->name ?? __('Unknown Designer') }}</p>
                        
                        <!-- Price -->
                        <div class="flex items-center mb-4">
                            @if($favorite->product->discount && $favorite->product->discount->percentage > 0)
                                <span class="text-gray-400 line-through mr-3">${{ number_format($favorite->product->price, 2) }}</span>
                                <span class="text-xl font-bold gradient-text">${{ number_format($favorite->product->price * (1 - $favorite->product->discount->percentage / 100), 2) }}</span>
                            @else
                                <span class="text-xl font-bold text-elegance-dark">${{ number_format($favorite->product->price, 2) }}</span>
                            @endif
                        </div>
                        
                        <!-- Meta Info -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <div class="text-yellow-500 text-sm">
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
                                
                                <span class="text-gray-600 ml-1">({{ number_format($avgRating, 1) }})</span>
                            </div>
                            <div class="text-xs text-gray-500">{{ __('Added') }} {{ $favorite->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-20 glass-effect rounded-2xl" id="empty-favorites">
                    <div class="text-8xl text-elegance-pink/30 mb-6">
                        <i class="far fa-heart"></i>
                    </div>
                    <h3 class="text-3xl font-light mb-4 text-elegance-dark">{{ __('Your favorites list is empty') }}</h3>
                    <p class="text-gray-600 mb-8">{{ __('Save your favorite designs to come back to them later') }}</p>
                    <a href="{{ route('products.index') }}" class="inline-block px-8 py-3 bg-gradient-to-r from-elegance-pink to-elegance-purple text-white rounded-lg hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold">
                        {{ __('Browse Products') }}
                    </a>
                </div>
            @endif
        </div>

        @if(count($favorites) > 0)
            <!-- Checkout Section -->
            <div class="glass-effect rounded-2xl p-10 text-center shadow-xl">
                <div class="flex flex-col md:flex-row justify-center items-center gap-12 mb-8">
                    <div class="text-center">
                        <div class="text-3xl font-bold gradient-text" id="total-items">{{ count($favorites) }}</div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">{{ __('Favorite Items') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold gradient-text">
                            ${{ number_format($favorites->sum(function($favorite) {
                                return $favorite->product->discount && $favorite->product->discount->percentage > 0 
                                    ? $favorite->product->price * (1 - $favorite->product->discount->percentage / 100)
                                    : $favorite->product->price;
                            }), 2) }}
                        </div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">{{ __('Total Value') }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold gradient-text">{{ $favorites->pluck('product.designer')->unique('id')->filter()->count() }}</div>
                        <div class="text-sm text-gray-600 uppercase tracking-wide">{{ __('Designers') }}</div>
                    </div>
                </div>
                
                <form action="{{ route('favorites.add-all-to-cart') }}" method="POST" id="add-all-form">
                    @csrf
                    <button type="submit" class="px-8 py-4 bg-gradient-to-r from-elegance-pink to-elegance-purple text-white rounded-lg hover:shadow-lg hover:-translate-y-1 transition-all duration-300 font-semibold text-lg">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        {{ __('Add All to Cart') }}
                    </button>
                </form>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-elegance-dark to-gray-700 text-white py-20 mt-24">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <!-- Company Info -->
                <div>
                    <a href="{{ route('landing') }}" class="text-3xl font-light mb-6 block">
                        Ele<span class="font-bold gradient-text">gance</span>
                    </a>
                    <p class="text-gray-300 mb-6">{{ __('A platform connecting distinguished fashion designers with customers seeking uniqueness.') }}</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-elegance-pink hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-elegance-pink hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-elegance-pink hover:-translate-y-1 transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-semibold mb-6 relative">
                        {{ __('Quick Links') }}
                        <div class="absolute -bottom-2 left-0 w-12 h-1 bg-gradient-to-r from-elegance-pink to-elegance-purple rounded"></div>
                    </h3>
                    <ul class="space-y-3 text-gray-300">
                        <li><a href="{{ route('landing') }}" class="hover:text-elegance-pink transition-colors duration-300">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-elegance-pink transition-colors duration-300">{{ __('Products') }}</a></li>
                        <li><a href="{{ route('designers.index') }}" class="hover:text-elegance-pink transition-colors duration-300">{{ __('Designers') }}</a></li>
                        <li><a href="{{ route('courses.index') }}" class="hover:text-elegance-pink transition-colors duration-300">{{ __('Courses') }}</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-semibold mb-6 relative">
                        {{ __('Contact Info') }}
                        <div class="absolute -bottom-2 left-0 w-12 h-1 bg-gradient-to-r from-elegance-pink to-elegance-purple rounded"></div>
                    </h3>
                    <div class="space-y-4 text-gray-300">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-elegance-pink mr-3"></i>
                            <span>{{ __('123 Fashion Street, Amman, Jordan') }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone-alt text-elegance-pink mr-3"></i>
                            <span>+962 77 123 4567</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-elegance-pink mr-3"></i>
                            <span>info@elegance.com</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-600 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ __('Elegance. All Rights Reserved.') }}</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.getElementById('header');
                if (window.scrollY > 50) {
                    header.classList.add('bg-white', 'shadow-lg');
                    header.classList.remove('bg-white/95');
                } else {
                    header.classList.add('bg-white/95');
                    header.classList.remove('bg-white', 'shadow-lg');
                }
            });

            // Toast notification
            function showToast(message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toast-message');
                const toastDiv = toast.querySelector('div');
                
                toastMessage.textContent = message;
                
                if (type === 'error') {
                    toastDiv.className = 'bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg';
                } else {
                    toastDiv.className = 'bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg';
                }
                
                toast.classList.remove('translate-y-24', 'opacity-0');
                toast.classList.add('translate-y-0', 'opacity-100');
                
                setTimeout(() => {
                    toast.classList.add('translate-y-24', 'opacity-0');
                    toast.classList.remove('translate-y-0', 'opacity-100');
                }, 3000);
            }

            // View toggle
            const viewButtons = document.querySelectorAll('.view-btn');
            const favoritesContainer = document.getElementById('favorites-container');

            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    viewButtons.forEach(btn => {
                        btn.classList.remove('border-elegance-pink', 'bg-elegance-pink', 'text-white');
                        btn.classList.add('border-gray-200', 'bg-white');
                    });
                    
                    this.classList.add('border-elegance-pink', 'bg-elegance-pink', 'text-white');
                    this.classList.remove('border-gray-200', 'bg-white');
                    
                    const view = this.dataset.view;
                    if (view === 'list') {
                        favoritesContainer.className = 'grid grid-cols-1 gap-8 mb-16';
                    } else {
                        favoritesContainer.className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16';
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('search-favorites');
            const designerFilter = document.getElementById('filter-designer');

            function filterFavorites() {
                const searchTerm = searchInput.value.toLowerCase();
                const designerId = designerFilter.value;
                const productCards = Array.from(document.querySelectorAll('[id^="favorite-"]'));

                let visibleCount = 0;
                productCards.forEach(card => {
                    const name = card.dataset.name.toLowerCase();
                    const cardDesignerId = card.dataset.designerId;
                    
                    const matchesSearch = name.includes(searchTerm);
                    const matchesDesigner = !designerId || cardDesignerId === designerId;
                    
                    if (matchesSearch && matchesDesigner) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update total items counter
                const totalItems = document.getElementById('total-items');
                if (totalItems) {
                    totalItems.textContent = visibleCount;
                }
            }

            searchInput.addEventListener('input', filterFavorites);
            designerFilter.addEventListener('change', filterFavorites);

            // Remove from favorites
            document.querySelectorAll('.remove-favorite').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    const url = this.getAttribute('data-url');
                    const productCard = this.closest('[id^="favorite-"]');
                    
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
                            productCard.style.opacity = '0';
                            productCard.style.transform = 'translateY(-20px)';
                            
                            setTimeout(() => {
                                productCard.remove();
                                filterFavorites();
                            }, 300);
                            
                            showToast('{{ __("Product removed from favorites") }}');
                        } else {
                            this.innerHTML = '<i class="fas fa-heart"></i>';
                            this.disabled = false;
                            showToast(data.message || '{{ __("Error removing product") }}', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.innerHTML = '<i class="fas fa-heart"></i>';
                        this.disabled = false;
                        showToast('{{ __("Connection error") }}', 'error');
                    });
                });
            });
        });

        // User menu toggle functionality
        function toggleUserMenu() {
            const dropdown = document.getElementById('userDropdown');
            const userMenu = document.querySelector('.user-menu');
            const chevron = userMenu.querySelector('.fa-chevron-down');
            
            dropdown.classList.toggle('opacity-0');
            dropdown.classList.toggle('invisible');
            dropdown.classList.toggle('-translate-y-2');
            chevron.classList.toggle('rotate-180');
        }

        // Close user menu when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.querySelector('.user-menu');
            const dropdown = document.getElementById('userDropdown');
            
            if (userMenu && !userMenu.contains(event.target)) {
                dropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
                userMenu.querySelector('.fa-chevron-down').classList.remove('rotate-180');
            }
        });

        // Close user menu on scroll
        window.addEventListener('scroll', function() {
            const dropdown = document.getElementById('userDropdown');
            const userMenu = document.querySelector('.user-menu');
            
            if (dropdown && !dropdown.classList.contains('opacity-0')) {
                dropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
                userMenu.querySelector('.fa-chevron-down').classList.remove('rotate-180');
            }
        });
    </script>

    <style>
        .nav-link {
            @apply text-elegance-dark font-medium transition-all duration-300 relative py-2;
        }
        .nav-link:hover {
            @apply text-elegance-pink;
        }
        .nav-link::after {
            content: '';
            @apply absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-elegance-pink to-elegance-purple transition-all duration-300;
        }
        .nav-link:hover::after {
            @apply w-full;
        }
    </style>
</body>
</html>