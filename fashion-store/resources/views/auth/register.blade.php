<x-guest-layout>
    <!-- Add all the CSS from the login example -->
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

        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .register-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #ffd1dc;
        }

        .register-header {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .register-header h1 {
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

        .register-header h1:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 2px;
            background-color: #ffd1dc;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .register-header p {
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
            animation-delay: 0.7s;
        }

        .form-group:nth-child(3) {
            animation-delay: 0.8s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.9s;
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

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .input-error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            font-weight: 300;
        }

        .login-link {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1.6s;
            font-weight: 300;
            color: #666;
        }

        .login-link a {
            color: #000;
            text-decoration: none;
            font-weight: 400;
            transition: all 0.3s;
        }

        .login-link a:hover {
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
        
        .actions-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1.2s;
        }
        
        .login-link-inline {
            color: #000;
            text-decoration: none;
            font-weight: 400;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .login-link-inline:hover {
            color: #ffd1dc;
        }
        
        .btn-register {
            padding: 12px 24px;
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
            position: relative;
            overflow: hidden;
        }

        .btn-register:hover {
            background-color: #333;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-register:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn-register:hover:before {
            left: 100%;
        }
        
        .social-register {
            margin-top: 40px;
            text-align: center;
            opacity: 0;
            animation: fadeIn 0.5s forwards 1.4s;
        }

        .social-register p {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            position: relative;
            font-weight: 300;
        }

        .social-register p::before,
        .social-register p::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background-color: #e0e0e0;
        }

        .social-register p::before {
            left: 0;
        }

        .social-register p::after {
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
        
        @media (max-width: 480px) {
            .register-container {
                padding: 30px 20px;
            }
            
            .register-header h1 {
                font-size: 24px;
            }
            
            .form-group label {
                font-size: 13px;
            }
            
            .actions-container {
                flex-direction: column;
                gap: 20px;
            }
            
            .login-link-inline {
                margin-bottom: 15px;
            }
            
            .btn-register {
                width: 100%;
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

    <div class="register-container">
        <div class="register-header">
            <h1>Create Account</h1>
            <p>Please fill in the form to register</p>
        </div>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf
            
            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <div class="input-icon">
                    <input id="name" class="form-control @error('name') invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    <i class="fas fa-user"></i>
                    <div class="cursor-focus"></div>
                </div>
                @error('name')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-icon">
                    <input id="email" class="form-control @error('email') invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
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
                    <input id="password" class="form-control @error('password') invalid @enderror" type="password" name="password" required autocomplete="new-password">
                    <i class="fas fa-lock"></i>
                    <div class="cursor-focus"></div>
                </div>
                @error('password')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="input-icon">
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                    <i class="fas fa-check-circle"></i>
                    <div class="cursor-focus"></div>
                </div>
                @error('password_confirmation')
                    <div class="input-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="actions-container">
                <a class="login-link-inline" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit" class="btn-register">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

        <!-- Social Register Section -->
        <div class="social-register">
            <p>Or register with</p>
            <div class="social-icons">
                <a href="#" class="social-icon google"><i class="fab fa-google"></i></a>
                <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <!-- Login Link -->
        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>
    </div>

    <script>
        // Simple form validation
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const registerForm = document.getElementById('registerForm');

        nameInput.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('invalid');
                this.classList.add('valid');
            }
        });

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
            } else if (this.value.length < 8) {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else {
                this.classList.remove('invalid');
                this.classList.add('valid');
            }
        });

        confirmPasswordInput.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('invalid');
                this.classList.remove('valid');
            } else if (this.value !== passwordInput.value) {
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