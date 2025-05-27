<x-guest-layout>
    <!-- Add all the CSS from the first example -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap');
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Montserrat', 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }

        .login-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #ffd1dc;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .login-header h1 {
            color: #000;
            font-size: 28px;
            font-weight: 300;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInDown 0.8s forwards 0.2s;
        }

        .login-header h1:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 2px;
            background-color: #ffd1dc;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .login-header p {
            color: #666;
            font-size: 14px;
            font-weight: 300;
            opacity: 0;
            transform: translateY(-15px);
            animation: fadeInDown 0.8s forwards 0.4s;
        }

        @keyframes fadeInDown {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
            opacity: 0;
            transform: translateX(-20px);
            animation: slideIn 0.5s forwards;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.6s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.8s;
        }

        @keyframes slideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 400;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 3px;
            font-size: 14px;
            transition: all 0.3s;
            background-color: #f9f9f9;
            font-family: 'Montserrat', sans-serif;
        }

        .form-control:focus {
            border-color: #ffd1dc;
            box-shadow: 0 0 0 3px rgba(255, 209, 220, 0.2);
            background-color: #fff;
            outline: none;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            transition: color 0.3s;
        }

        .input-icon input {
            padding-right: 40px;
        }

        .input-icon input:focus + i {
            color: #ffd1dc;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0 30px;
            font-size: 14px;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1s;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: #000;
        }

        .remember-me span {
            font-weight: 300;
            color: #666;
        }

        .forgot-password {
            color: #000;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 400;
        }

        .forgot-password:hover {
            color: #ffd1dc;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #000;
            border: none;
            border-radius: 3px;
            color: white;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Montserrat', sans-serif;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1.2s;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background-color: #333;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-login:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-login:hover:before {
            left: 100%;
        }

        .status-message {
            padding: 12px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 3px;
            font-size: 14px;
            text-align: center;
            border: 1px solid #c3e6cb;
        }

        .input-error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            font-weight: 300;
        }

        .social-login {
            margin-top: 40px;
            text-align: center;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1.4s;
        }

        .social-login p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            position: relative;
            font-weight: 300;
        }

        .social-login p::before,
        .social-login p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #e0e0e0;
        }

        .social-login p::before {
            left: 0;
        }

        .social-login p::after {
            right: 0;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .social-icon:hover {
            transform: translateY(-3px) scale(1.1);
        }

        .google {
            background-color: #db4437;
        }

        .facebook {
            background-color: #4267B2;
        }

        .twitter {
            background-color: #1DA1F2;
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1.6s;
            font-weight: 300;
            color: #666;
        }

        .register-link a {
            color: #000;
            text-decoration: none;
            font-weight: 400;
            transition: all 0.3s;
        }

        .register-link a:hover {
            color: #ffd1dc;
        }

        /* Form validation styling */
        .form-control.valid {
            border-color: #2ecc71;
        }

        .form-control.invalid {
            border-color: #e74c3c;
        }

        /* Focus effect */
        .cursor-focus {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #ffd1dc;
            transition: width 0.3s;
        }

        .form-control:focus ~ .cursor-focus {
            width: 100%;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .login-header h1 {
                font-size: 24px;
            }
            
            .form-group label {
                font-size: 13px;
            }
            
            .social-icon {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }
        }
    </style>

    <!-- Add Font Awesome from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <div class="login-container">
        <div class="login-header">
            <h1>Welcome Back</h1>
            <p>Please enter your credentials to sign in</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="status-message mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            
            <!-- Add hidden redirect field -->
            <input type="hidden" name="redirect" value="{{ request()->get('redirect', '/') }}">
            
            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <input id="email" class="form-control @error('email') invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    <i class="fas fa-envelope"></i>
                    <div class="cursor-focus"></div>
                </div>
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-icon">
                    <input id="password" class="form-control @error('password') invalid @enderror" type="password" name="password" required autocomplete="current-password">
                    <i class="fas fa-lock"></i>
                    <div class="cursor-focus"></div>
                </div>
                @error('password')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="remember-forgot">
                <label class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                {{ __('Sign In') }}
            </button>
        </form>

        <!-- Social Login Section -->
        <div class="social-login">
            <p>Or sign in with</p>
            <div class="social-icons">
                <a href="#" class="social-icon google"><i class="fab fa-google"></i></a>
                <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <!-- Register Link -->
        <div class="register-link">
            Don't have an account? <a href="{{ route('register') }}">Create a new account</a>
        </div>
    </div>

    <script>
        // Simple email validation
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginForm = document.getElementById('loginForm');

        emailInput.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else if (!validateEmail(this.value)) {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('invalid');
                this.classList.add('valid');
            }
        });

        passwordInput.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else if (this.value.length < 6) {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('invalid');
                this.classList.add('valid');
            }
        });

        // Email validation function
        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        // Add hover effects for social icons
        const socialIcons = document.querySelectorAll('.social-icon');
        socialIcons.forEach(icon => {
            icon.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.1)';
            });
            
            icon.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</x-guest-layout>