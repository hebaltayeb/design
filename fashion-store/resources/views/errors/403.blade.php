<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-pulse-slow {
            animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Main Error Card -->
        <div class="glass-effect rounded-3xl p-8 text-center shadow-2xl">
            <!-- Animated Lock Icon -->
            <div class="animate-float mb-8">
                <div class="mx-auto w-24 h-24 bg-red-500 rounded-full flex items-center justify-center animate-pulse-slow">
                    <i class="fas fa-lock text-white text-4xl"></i>
                </div>
            </div>

            <!-- Error Code -->
            <h1 class="text-6xl font-bold text-white mb-4 animate-pulse">403</h1>
            
            <!-- Error Message -->
            <h2 class="text-2xl font-semibold text-white mb-4">Access Denied</h2>
            <p class="text-gray-200 mb-8 leading-relaxed">
                Sorry, you don't have permission to access this page. This area is restricted to administrators only.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <button onclick="goBack()" 
                        class="w-full bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 backdrop-blur-sm border border-white border-opacity-30">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Go Back
                </button>
                
                <a href="{{ route('landing') }}" 
                   class="block w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-home mr-2"></i>
                    Back to Home
                </a>
            </div>

            <!-- Contact Support -->
            <div class="mt-8 pt-6 border-t border-white border-opacity-20">
                <p class="text-gray-300 text-sm mb-3">Need help?</p>
                <a href="mailto:support@fashionstore.com" 
                   class="inline-flex items-center text-pink-300 hover:text-pink-200 transition-colors duration-300">
                    <i class="fas fa-envelope mr-2"></i>
                    Contact Support
                </a>
            </div>
        </div>

        <!-- Floating Elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-pink-400 bg-opacity-20 rounded-full animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-16 h-16 bg-purple-400 bg-opacity-20 rounded-full animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 left-5 w-12 h-12 bg-blue-400 bg-opacity-20 rounded-full animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <script>
        function goBack() {
            if (window.history.length > 1) {
                window.history.back();
            } else {
                window.location.href = '{{ route("landing") }}';
            }
        }

        // Add some interactive effects
        document.addEventListener('mousemove', function(e) {
            const cards = document.querySelectorAll('.glass-effect');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const cardX = (rect.left + rect.width / 2) / window.innerWidth;
                const cardY = (rect.top + rect.height / 2) / window.innerHeight;
                
                const deltaX = (x - cardX) * 10;
                const deltaY = (y - cardY) * 10;
                
                card.style.transform = `perspective(1000px) rotateX(${deltaY}deg) rotateY(${deltaX}deg)`;
            });
        });
    </script>
</body>
</html>