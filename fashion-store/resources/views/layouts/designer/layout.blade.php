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
                <a href="/" class="text-2xl font-bold text-gray-900">
                    Elegant<span class="text-pink-500">Style</span>
                </a>
                <nav class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-600 hover:text-pink-500 transition-colors">Home</a>
                    <a href="{{ route('designer.dashboard') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Dashboard</a>
                    <a href="{{ route('designer.products.index') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Products</a>
                    <a href="{{ route('designer.courses.index') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Courses</a>
                    <a href="{{ route('designer.orders.index') }}" class="text-gray-600 hover:text-pink-500 transition-colors">Orders</a>
                    <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors">Profile</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Scripts -->
    <script>
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
    </script>
    @stack('scripts')
</body>

</html>