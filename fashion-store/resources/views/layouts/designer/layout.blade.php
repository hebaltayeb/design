<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Designer Dashboard - ElegantStyle')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-100 fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('landing') }}" class="text-2xl font-bold text-gray-900">
                    Elegant<span class="text-pink-500">Style</span>
                </a>
                
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('landing') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Home</a>
                    <a href="{{ route('designer.dashboard') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Dashboard</a>
                    <a href="{{ route('designer.products.index') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Products</a>
                    <a href="{{ route('designer.courses.index') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Courses</a>
                    <a href="{{ route('designer.orders.index') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Orders</a>
                    <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Profile</a>
                </nav>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    <!-- User Info -->
                    <div class="hidden md:flex items-center space-x-3">
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Designer</p>
                        </div>
                        <img class="h-8 w-8 rounded-full object-cover border-2 border-pink-200" 
                             src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=ec4899&color=fff' }}" 
                             alt="{{ auth()->user()->name }}">
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('designer.logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                                onclick="return confirm('Are you sure you want to logout?')">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            Logout
                        </button>
                    </form>

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 rounded-md text-gray-600 hover:text-pink-500 hover:bg-gray-100" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden border-t border-gray-200 py-4">
                <div class="space-y-2">
                    <a href="{{ route('landing') }}" class="block px-4 py-2 text-gray-600 hover:text-pink-500 transition-colors">Home</a>
                    <a href="{{ route('designer.dashboard') }}" class="block px-4 py-2 text-gray-600 hover:text-pink-500 transition-colors">Dashboard</a>
                    <a href="{{ route('designer.products.index') }}" class="block px-4 py-2 text-gray-600 hover:text-pink-500 transition-colors">Products</a>
                    <a href="{{ route('designer.courses.index') }}" class="block px-4 py-2 text-gray-600 hover:text-pink-500 transition-colors">Courses</a>
                    <a href="{{ route('designer.orders.index') }}" class="block px-4 py-2 text-gray-600 hover:text-pink-500 transition-colors">Orders</a>
                    <a href="#" class="block px-4 py-2 text-gray-600 hover:text-pink-500 transition-colors">Profile</a>
                    
                    <!-- Mobile User Info & Logout -->
                    <div class="border-t border-gray-200 pt-4 mt-4">
                        <div class="flex items-center px-4 py-2">
                            <img class="h-8 w-8 rounded-full object-cover border-2 border-pink-200" 
                                 src="{{ auth()->user()->profile_picture ? asset('storage/'.auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&background=ec4899&color=fff' }}" 
                                 alt="{{ auth()->user()->name }}">
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">Designer</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('designer.logout') }}" class="px-4">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-medium rounded-md transition-colors duration-200"
                                    onclick="return confirm('Are you sure you want to logout?')">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md mb-4 mx-4 mt-4">
                <div class="flex">
                    <i class="fas fa-check-circle mr-2 text-green-500 mt-0.5"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md mb-4 mx-4 mt-4">
                <div class="flex">
                    <i class="fas fa-exclamation-circle mr-2 text-red-500 mt-0.5"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        // Tab navigation functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-pink-500', 'text-pink-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Add active class to clicked tab button
            event.target.classList.remove('border-transparent', 'text-gray-500');
            event.target.classList.add('border-pink-500', 'text-pink-600');
        }

        // Modal functions
        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('modal-backdrop')) {
                hideModal(e.target.id);
            }
        });

        // Auto-hide success/error messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
    @stack('scripts')
</body>

</html>