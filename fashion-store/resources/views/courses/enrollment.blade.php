<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $course->title }} - Enrollment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'fashion-pink': '#ff6b9d',
                        'fashion-dark': '#c44569',
                        'fashion-gray': '#2c3e50',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-poppins bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    
    <!-- Header -->
    <div class="bg-white/80 backdrop-blur-md shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('courses.show', $course) }}" 
                   class="flex items-center space-x-2 text-fashion-gray hover:text-fashion-pink transition-colors duration-300">
                    <i class="fas fa-arrow-left text-lg"></i>
                    <span class="font-medium">Back to Course</span>
                </a>
                <div class="text-sm text-gray-500">
                    Course Enrollment
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-light text-fashion-gray mb-4 leading-tight">
                Enroll in <span class="font-semibold bg-gradient-to-r from-fashion-pink to-fashion-dark bg-clip-text text-transparent">Course</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Complete the enrollment for {{ $course->title }}
            </p>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-8">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-8">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-3 gap-12">
            
            <!-- Left Column - Enrollment Form -->
            <div class="lg:col-span-2">
                <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
                    
                    <h2 class="text-2xl font-semibold text-fashion-gray mb-8 flex items-center">
                        <i class="fas fa-user-plus text-fashion-pink mr-3"></i>
                        Enrollment Information
                    </h2>

                    <form action="{{ route('courses.enrollments.store', $course) }}" method="POST" class="space-y-6">
                        @csrf

                        @guest
                        <!-- Account Creation Section -->
                        <div class="bg-gradient-to-r from-fashion-pink/10 to-fashion-dark/10 rounded-2xl p-6 mb-8">
                            <h3 class="text-lg font-semibold text-fashion-gray mb-4 flex items-center">
                                <i class="fas fa-user-circle text-fashion-pink mr-2"></i>
                                Create Your Account
                            </h3>
                            
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Full Name *
                                    </label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address *
                                    </label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Password *
                                    </label>
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
                                    <p class="text-sm text-gray-500 mt-1">Create a password for your account</p>
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirm Password *
                                    </label>
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
                                    @error('password_confirmation')
                                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endguest

                        <!-- Contact Information -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number (Optional)
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Additional Notes (Optional)
                            </label>
                            <textarea id="notes" 
                                      name="notes" 
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-fashion-pink focus:border-transparent transition-all duration-300"
                                      placeholder="Any special requirements or questions...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Payment Method Section -->
                        <div>
                            <h3 class="text-lg font-semibold text-fashion-gray mb-6 flex items-center">
                                <i class="fas fa-credit-card text-fashion-pink mr-2"></i>
                                Payment Method
                            </h3>

                            <div class="space-y-4">
                                <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-fashion-pink hover:bg-fashion-pink/5 transition-all duration-300 payment-option" data-value="credit_card">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="credit_card" 
                                           class="sr-only payment-radio"
                                           checked>
                                    <div class="flex items-center w-full">
                                        <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-4 flex items-center justify-center radio-circle">
                                            <div class="w-3 h-3 bg-fashion-pink rounded-full opacity-0 radio-dot"></div>
                                        </div>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-credit-card text-2xl text-fashion-pink mr-4"></i>
                                            <div>
                                                <div class="font-semibold text-gray-900">Credit Card</div>
                                                <div class="text-sm text-gray-600">Secure payment with your credit card</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-fashion-pink hover:bg-fashion-pink/5 transition-all duration-300 payment-option" data-value="paypal">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="paypal" 
                                           class="sr-only payment-radio">
                                    <div class="flex items-center w-full">
                                        <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-4 flex items-center justify-center radio-circle">
                                            <div class="w-3 h-3 bg-fashion-pink rounded-full opacity-0 radio-dot"></div>
                                        </div>
                                        <div class="flex items-center flex-1">
                                            <i class="fab fa-paypal text-2xl text-blue-600 mr-4"></i>
                                            <div>
                                                <div class="font-semibold text-gray-900">PayPal</div>
                                                <div class="text-sm text-gray-600">Pay securely with your PayPal account</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-2xl cursor-pointer hover:border-fashion-pink hover:bg-fashion-pink/5 transition-all duration-300 payment-option" data-value="bank_transfer">
                                    <input type="radio" 
                                           name="payment_method" 
                                           value="bank_transfer" 
                                           class="sr-only payment-radio">
                                    <div class="flex items-center w-full">
                                        <div class="w-6 h-6 border-2 border-gray-300 rounded-full mr-4 flex items-center justify-center radio-circle">
                                            <div class="w-3 h-3 bg-fashion-pink rounded-full opacity-0 radio-dot"></div>
                                        </div>
                                        <div class="flex items-center flex-1">
                                            <i class="fas fa-university text-2xl text-green-600 mr-4"></i>
                                            <div>
                                                <div class="font-semibold text-gray-900">Bank Transfer</div>
                                                <div class="text-sm text-gray-600">Direct bank transfer payment</div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-fashion-pink to-fashion-dark text-white font-semibold py-4 px-8 rounded-2xl hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 text-lg">
                            <i class="fas fa-graduation-cap mr-3"></i>
                            Complete Enrollment - ${{ number_format($course->price, 2) }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column - Course Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/20">
                        
                        <h2 class="text-2xl font-semibold text-fashion-gray mb-6 flex items-center">
                            <i class="fas fa-book text-fashion-pink mr-3"></i>
                            Course Summary
                        </h2>

                        <!-- Course Image -->
                        <img src="{{ $course->image ? asset('storage/' . $course->image) : 'https://via.placeholder.com/400x250' }}" 
                             alt="{{ $course->title }}" 
                             class="w-full h-48 object-cover rounded-2xl mb-6">

                        <!-- Course Info -->
                        <h3 class="text-xl font-semibold text-fashion-gray mb-4">{{ $course->title }}</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($course->description, 150) }}</p>

                        <!-- Course Meta -->
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Instructor</span>
                                <span class="text-fashion-gray">{{ $course->designer->name }}</span>
                            </div>
                            
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Category</span>
                                <span class="text-fashion-gray">{{ $course->category->name }}</span>
                            </div>
                            
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Duration</span>
                                <span class="text-fashion-gray">{{ $course->duration ?? 'Self-paced' }} hours</span>
                            </div>
                            
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-medium text-gray-600">Level</span>
                                <span class="text-fashion-gray capitalize">{{ $course->level ?? 'All Levels' }}</span>
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="bg-gradient-to-r from-fashion-pink/10 to-fashion-dark/10 rounded-2xl p-6">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-600">Course Price</span>
                                <span class="text-2xl font-bold text-fashion-gray">${{ number_format($course->price, 2) }}</span>
                            </div>
                            
                            <div class="border-t border-gray-300 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-fashion-gray">Total</span>
                                    <span class="text-2xl font-bold text-fashion-gray">${{ number_format($course->price, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Security Badge -->
                        <div class="mt-6 text-center">
                            <div class="inline-flex items-center text-sm text-gray-600">
                                <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                Secure SSL encrypted payment
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-fashion-gray to-slate-800 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <p class="text-lg">&copy; {{ date('Y') }} Fashion Design Platform. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Payment method selection
        document.querySelectorAll('.payment-option').forEach(option => {
            option.addEventListener('click', function() {
                // Remove active state from all options
                document.querySelectorAll('.payment-option').forEach(opt => {
                    opt.classList.remove('border-fashion-pink', 'bg-fashion-pink/5');
                    opt.classList.add('border-gray-200');
                    opt.querySelector('.radio-circle').classList.remove('border-fashion-pink');
                    opt.querySelector('.radio-circle').classList.add('border-gray-300');
                    opt.querySelector('.radio-dot').classList.add('opacity-0');
                    opt.querySelector('.payment-radio').checked = false;
                });
                
                // Add active state to clicked option
                this.classList.remove('border-gray-200');
                this.classList.add('border-fashion-pink', 'bg-fashion-pink/5');
                this.querySelector('.radio-circle').classList.remove('border-gray-300');
                this.querySelector('.radio-circle').classList.add('border-fashion-pink');
                this.querySelector('.radio-dot').classList.remove('opacity-0');
                this.querySelector('.payment-radio').checked = true;
            });
        });

        // Initialize first option as selected
        document.addEventListener('DOMContentLoaded', function() {
            const firstOption = document.querySelector('.payment-option');
            if (firstOption) {
                firstOption.click();
            }
        });
    </script>
</body>
</html>