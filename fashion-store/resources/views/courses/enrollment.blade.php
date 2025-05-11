<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $course->title }} - Enrollment</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      font-family: 'Poppins', 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #333;
      line-height: 1.6;
    }
    
    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .back-button {
      position: absolute;
      top: 30px;
      left: 30px;
      text-decoration: none;
      color: #000;
      font-size: 16px;
      display: flex;
      align-items: center;
    }
    
    .back-button i {
      margin-right: 5px;
    }
    
    .enrollment-header {
      text-align: center;
      padding: 30px 0;
    }
    
    .enrollment-title {
      font-size: 32px;
      font-weight: 500;
      margin-bottom: 15px;
    }
    
    .enrollment-subtitle {
      font-size: 18px;
      color: #666;
      margin-bottom: 30px;
    }
    
    .enrollment-form-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 40px;
    }
    
    @media (max-width: 768px) {
      .enrollment-form-container {
        grid-template-columns: 1fr;
      }
    }
    
    .enrollment-details {
      background: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .course-summary {
      background: white;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      height: fit-content;
    }
    
    .course-image {
      width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    
    .summary-title {
      font-size: 24px;
      font-weight: 500;
      margin: 0 0 20px 0;
    }
    
    .course-meta {
      margin-bottom: 20px;
    }
    
    .meta-item {
      display: flex;
      margin-bottom: 10px;
    }
    
    .meta-label {
      font-weight: 500;
      width: 40%;
    }
    
    .meta-value {
      width: 60%;
      color: #666;
    }
    
    .price-summary {
      border-top: 1px solid #eee;
      padding-top: 20px;
      margin-top: 20px;
    }
    
    .price-item {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
    }
    
    .total-price {
      display: flex;
      justify-content: space-between;
      font-size: 20px;
      font-weight: 500;
      margin-top: 15px;
      padding-top: 15px;
      border-top: 1px solid #eee;
    }
    
    form {
      margin-top: 20px;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
    }
    
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="password"],
    select {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
      font-family: inherit;
    }
    
    input:focus,
    select:focus {
      outline: none;
      border-color: #000;
    }
    
    .payment-methods {
      margin: 20px 0;
    }
    
    .payment-method {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      padding: 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.2s ease;
    }
    
    .payment-method:hover {
      border-color: #000;
    }
    
    .payment-method.active {
      border-color: #000;
      background-color: #f9f9f9;
    }
    
    .payment-icon {
      margin-right: 15px;
      font-size: 24px;
    }
    
    .payment-title {
      font-weight: 500;
    }
    
    .btn {
      display: block;
      width: 100%;
      background-color: #000;
      color: white;
      padding: 15px;
      text-decoration: none;
      font-size: 16px;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      border-radius: 3px;
      text-align: center;
      margin-top: 20px;
    }
    
    .btn:hover {
      background-color: #333;
      transform: translateY(-3px);
    }
    
    .errors {
      color: #d9534f;
      margin-top: 5px;
      font-size: 14px;
    }
    
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 4px;
    }
    
    .alert-success {
      background-color: #dff0d8;
      color: #3c763d;
      border: 1px solid #d6e9c6;
    }
    
    .alert-danger {
      background-color: #f2dede;
      color: #a94442;
      border: 1px solid #ebccd1;
    }
    
    footer {
      background-color: #000;
      color: white;
      padding: 40px 0;
      text-align: center;
      font-size: 15px;
      font-weight: 300;
      margin-top: 80px;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ route('courses.show', $course) }}" class="back-button">
      <i class="fas fa-arrow-left"></i> Back to Course
    </a>
    
    <div class="enrollment-header">
      <h1 class="enrollment-title">Enroll in Course</h1>
      <p class="enrollment-subtitle">Complete the form below to enroll in {{ $course->title }}</p>
    </div>
    
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    
    @if(session('error'))
      <div class="alert alert-danger">
        {{ session('error') }}
      </div>
    @endif
    
    <div class="enrollment-form-container">
      <div class="enrollment-details">
        <h2>Your Information</h2>
        
        <form action="{{ route('courses.enrollments.store', $course) }}" method="POST">
          @csrf
          
          @guest
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" required>
              @error('name')
                <div class="errors">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required>
              @error('email')
                <div class="errors">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required>
              <small>Create a password for your account</small>
              @error('password')
                <div class="errors">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" id="password_confirmation" name="password_confirmation" required>
              @error('password_confirmation')
                <div class="errors">{{ $message }}</div>
              @enderror
            </div>
          @endguest
          
          <div class="form-group">
            <label for="phone">Phone Number (Optional)</label>
            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
              <div class="errors">{{ $message }}</div>
            @enderror
          </div>
          
          <h3>Payment Method</h3>
          <div class="payment-methods">
            <div class="payment-method active">
              <input type="radio" id="creditCard" name="payment_method" value="credit_card" checked>
              <div class="payment-icon"><i class="fas fa-credit-card"></i></div>
              <div class="payment-title">Credit Card</div>
            </div>
            
            <div class="payment-method">
              <input type="radio" id="paypal" name="payment_method" value="paypal">
              <div class="payment-icon"><i class="fab fa-paypal"></i></div>
              <div class="payment-title">PayPal</div>
            </div>
            
            <div class="payment-method">
              <input type="radio" id="bankTransfer" name="payment_method" value="bank_transfer">
              <div class="payment-icon"><i class="fas fa-university"></i></div>
              <div class="payment-title">Bank Transfer</div>
            </div>
          </div>
          @error('payment_method')
            <div class="errors">{{ $message }}</div>
          @enderror
          
          <button type="submit" class="btn">Complete Enrollment</button>
        </form>
      </div>
      
      <div class="course-summary">
        <h2 class="summary-title">Course Summary</h2>
        <img src="{{ $course->image ?? 'https://via.placeholder.com/500x280' }}" alt="{{ $course->title }}" class="course-image">
        
        <h3>{{ $course->title }}</h3>
        <p>{{ Str::limit($course->description, 100) }}</p>
        
        <div class="course-meta">
          <div class="meta-item">
            <div class="meta-label">Instructor</div>
            <div class="meta-value">{{ $course->designer->name }}</div>
          </div>
          
          <div class="meta-item">
            <div class="meta-label">Category</div>
            <div class="meta-value">{{ $course->category->name }}</div>
          </div>
          
          <div class="meta-item">
            <div class="meta-label">Duration</div>
            <div class="meta-value">{{ $course->duration ?? 'N/A' }} hours</div>
          </div>
          
          <div class="meta-item">
            <div class="meta-label">Level</div>
            <div class="meta-value">{{ $course->level ?? 'All Levels' }}</div>
          </div>
        </div>
        
        <div class="price-summary">
          <div class="price-item">
            <div>Course Price</div>
            <div>${{ number_format($course->price, 2) }}</div>
          </div>
          
          @if(isset($couponDiscount) && $couponDiscount > 0)
            <div class="price-item">
              <div>Coupon Discount</div>
              <div>-${{ number_format($couponDiscount, 2) }}</div>
            </div>
          @endif
          
          <div class="total-price">
            <div>Total</div>
            <div>${{ number_format(isset($couponDiscount) ? $course->price - $couponDiscount : $course->price, 2) }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <footer>
    <p>&copy; {{ date('Y') }} Fashion Design Courses Platform. All Rights Reserved.</p>
  </footer>
  
  <script>
    // Payment method selection
    document.querySelectorAll('.payment-method').forEach(method => {
      method.addEventListener('click', function() {
        // Remove active class from all payment methods
        document.querySelectorAll('.payment-method').forEach(m => {
          m.classList.remove('active');
          m.querySelector('input').checked = false;
        });
        
        // Add active class to clicked payment method
        this.classList.add('active');
        this.querySelector('input').checked = true;
      });
    });
  </script>
</body>
</html>