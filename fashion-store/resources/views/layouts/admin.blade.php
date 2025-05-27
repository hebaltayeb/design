<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Fashion Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'custom-pink': '#ffd1dc',
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .sidebar-item.active {
            background-color: #ffd1dc;
            color: black;
        }

        .sidebar-item:hover .sidebar-icon {
            transform: translateX(5px);
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 209, 220, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(255, 209, 220, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 209, 220, 0);
            }
        }
    </style>
    @yield('styles')
</head>

<body class="bg-gray-100">
    @auth
        @if(!in_array(auth()->user()->role, ['admin', 'super_admin']))
            <script>window.location.href = "{{ url('/403') }}";</script>
        @endif
    @else
        <script>window.location.href = "{{ route('login') }}";</script>
    @endauth
    
    <div x-data="{ sidebarOpen: window.innerWidth >= 1024 }" class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div :class="{'translate-x-0 shadow-2xl': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition-all duration-300 transform bg-black lg:translate-x-0 lg:static lg:inset-0">

            <div class="flex items-center justify-between mt-8 px-6">
                <div class="flex items-center">
                    <img src="https://via.placeholder.com/40" alt="Logo" class="h-10 w-10 rounded-full border-2 border-custom-pink">
                    <span class="ml-3 text-2xl font-bold text-custom-pink">Fashion Admin</span>
                </div>
                <button @click="sidebarOpen = false" class="lg:hidden text-white hover:text-custom-pink">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mt-10 px-4">
                <!-- User profile preview in sidebar -->
                <div class="mb-8 p-3 bg-gray-900 rounded-lg">
                    <div class="flex items-center">
                        <img class="object-cover w-10 h-10 rounded-full border-2 border-custom-pink"
                            src=""
                            alt="User profile">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-white"></p>
                            <p class="text-xs text-gray-400">Administrator</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-1">
                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="{{ route('admin.dashboard') }}">
                        <i class="sidebar-icon fas fa-tachometer-alt mr-3 transition-transform duration-300"></i>
                        <span>Dashboard</span>
                    </a>

                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="{{ route('admin.products.index') }}">
                        <i class="sidebar-icon fas fa-tshirt mr-3 transition-transform duration-300"></i>
                        <span>Products</span>
                    </a>

                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="{{ route('admin.users.index') }}">
                        <i class="sidebar-icon fas fa-users mr-3 transition-transform duration-300"></i>
                        <span>Users</span>
                    </a>

                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="{{ route('admin.orders.index') }}">
                        <i class="sidebar-icon fas fa-shopping-cart mr-3 transition-transform duration-300"></i>
                        <span>Orders</span>
                    </a>

                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="{{ route('admin.categories.index') }}">
                        <i class="sidebar-icon fas fa-tags mr-3 transition-transform duration-300"></i>
                        <span>Categories</span>
                    </a>

                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="{{ route('admin.courses.index') }}">

                        <i class="sidebar-icon fas fa-book mr-3 transition-transform duration-300"></i>
                        <span>Courses</span>
                    </a>

                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="">
                        <i class="sidebar-icon fas fa-calendar mr-3 transition-transform duration-300"></i>
                        <span>Events</span>
                    </a>

                    <a class="sidebar-item flex items-center px-6 py-3 rounded-lg text-white hover:bg-gray-800 transition-all duration-300"
                        href="{{ route('admin.coupons.index') }}">
                        <i class="sidebar-icon fas fa-percent mr-3 transition-transform duration-300"></i>
                        <span>Coupons</span>
                    </a>
                </div>

                <!-- Bottom area with help and settings -->

            </div>
        </div>

        <!-- Content area -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <header class="flex items-center justify-between px-6 py-3 bg-black text-white shadow-md">
                <div class="flex items-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-white hover:text-custom-pink focus:outline-none transition-transform duration-300"
                        :class="{'rotate-180': sidebarOpen}">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="ml-6 hidden md:flex">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-search text-gray-400"></i>
                            </span>
                            <input class="pl-10 pr-4 py-2 rounded-lg text-sm bg-gray-900 border border-gray-800 focus:outline-none focus:border-custom-pink"
                                placeholder="Search...">
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="text-gray-400 hover:text-white">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 rounded-full bg-custom-pink pulse"></span>
                        </button>
                    </div>

                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="relative flex items-center space-x-2 focus:outline-none">
                            <img class="object-cover w-8 h-8 rounded-full border-2 border-custom-pink"
                                src=""
                                alt="User profile">
                            <div class="hidden md:block text-left">
                                <span class="block text-sm font-medium"></span>
                                <span class="block text-xs text-gray-400">Admin</span>
                            </div>
                            <i class="fas fa-chevron-down text-xs text-custom-pink"></i>
                        </button>

                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="fixed inset-0 z-10" style="display: none;"></div>

                        <div x-show="dropdownOpen"
                            class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-lg shadow-lg"
                            style="display: none;">
                            <a href="" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-custom-pink hover:text-black">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                            <a href="" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-custom-pink hover:text-black">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-custom-pink hover:text-black">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @if(session('success'))
                    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        <div class="flex">
                            <i class="fas fa-check-circle mr-2 text-green-500"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                        <div class="flex">
                            <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Set active menu item
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar-item');

            menuItems.forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>