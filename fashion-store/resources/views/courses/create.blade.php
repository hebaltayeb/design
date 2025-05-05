<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create New Course - Fashion Design Platform</title>
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
      direction: ltr;
    }
    
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    
    header {
      text-align: center;
      padding: 30px 0;
    }
    
    h1 {
      color: #000;
      font-size: 32px;
      font-weight: 300;
      text-transform: uppercase;
      letter-spacing: 3px;
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }
    
    h1:after {
      content: '';
      position: absolute;
      width: 80px;
      height: 2px;
      background-color: #ffd1dc;
      bottom: -15px;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .subtitle {
      font-size: 16px;
      color: #666;
      max-width: 700px;
      margin: 20px auto;
      text-align: center;
    }
    
    .form-container {
      background: white;
      border-radius: 8px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      padding: 40px;
      margin-top: 20px;
    }
    
    .form-group {
      margin-bottom: 25px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #333;
    }
    
    .form-group input,
    .form-group textarea,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #e0e0e0;
      border-radius: 5px;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      transition: border-color 0.3s ease;
    }
    
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      border-color: #333;
    }
    
    .form-group textarea {
      height: 150px;
      resize: vertical;
    }
    
    .btn {
      display: inline-block;
      background-color: #000;
      color: white;
      padding: 12px 30px;
      text-decoration: none;
      font-size: 16px;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      text-transform: uppercase;
      border: none;
      cursor: pointer;
      border-radius: 3px;
      font-weight: 500;
    }
    
    .btn:hover {
      background-color: #333;
      transform: translateY(-3px);
    }
    
    .form-footer {
      text-align: center;
      margin-top: 30px;
    }
    
    .error-message {
      color: #d9534f;
      font-size: 14px;
      margin-top: 5px;
    }
    
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border-radius: 5px;
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
    
    @media (max-width: 768px) {
      .form-container {
        padding: 25px;
      }
      
      h1 {
        font-size: 28px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1>Create New Course</h1>
      <p class="subtitle">Share your fashion design knowledge with eager students</p>
    </header>

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

    <div class="form-container">
      <form action="{{ route('designer.courses.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="title">Course Title</label>
          <input type="text" id="title" name="title" value="{{ old('title') }}" required>
          @error('title')
            <div class="error-message">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="description">Course Description</label>
          <textarea id="description" name="description" required>{{ old('description') }}</textarea>
          @error('description')
            <div class="error-message">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="price">Price ($)</label>
          <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
          @error('price')
            <div class="error-message">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="video_url">Video URL</label>
          <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://example.com/video" required>
          @error('video_url')
            <div class="error-message">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-group">
          <label for="category_id">Category</label>
          <select id="category_id" name="category_id" required>
            <option value="">Select a category</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          @error('category_id')
            <div class="error-message">{{ $message }}</div>
          @enderror
        </div>

        <div class="form-footer">
          <button type="submit" class="btn">Create Course</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Optional: Add client-side validation if needed
    document.querySelector('form').addEventListener('submit', function(e) {
      // Example validation
      const price = document.getElementById('price').value;
      if (parseFloat(price) < 0) {
        e.preventDefault();
        alert('Price cannot be negative.');
      }
    });
  </script>
</body>
</html>