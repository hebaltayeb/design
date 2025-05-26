<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .form-header {
            background: linear-gradient(45deg, #4e73df, #224abe);
            color: white;
            padding: 1.5rem;
        }
        .form-logo {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }
        .form-body {
            padding: 2rem;
            background-color: white;
        }
        .preview-image {
            max-height: 150px;
            border-radius: 5px;
            object-fit: cover;
        }
        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }
        .btn-primary:hover {
            background-color: #224abe;
            border-color: #224abe;
        }
        .designer-card {
            border-left: 4px solid #4e73df;
            background-color: #f8f9ff;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Page Header with Simple Navigation -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-dark">
                        <a href="{{ route('products.index') }}" class="text-decoration-none text-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                        </a>
                        Create New Product
                    </h1>
                </div>

                <!-- Designer Info Card -->
                @if(Auth::check() && (Auth::user()->is_designer || Auth::user()->is_admin))
                <div class="card designer-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar bg-primary text-white rounded-circle p-3 me-3">
                                <i class="bi bi-person-fill fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">Creating as: {{ Auth::user()->name }}</h5>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-primary">{{ Auth::user()->is_admin ? 'Administrator' : 'Designer' }}</span>
                                    <small class="ms-2">Products created will be associated with your account</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Product Form Card -->
                <div class="form-card mb-4">
                    <div class="form-header d-flex align-items-center">
                        <div class="form-logo">
                            <i class="bi bi-plus-lg text-primary fs-5"></i>
                        </div>
                        <h2 class="mb-0">Product Information</h2>
                    </div>
                    
                    <div class="form-body">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Hidden input to store designer ID -->
                            <input type="hidden" name="designer_id" value="{{ Auth::id() }}">
                            
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-7 pe-md-4">
                                    <div class="mb-4">
                                        <label for="name" class="form-label fw-bold">Product Name</label>
                                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}" placeholder="Enter product name" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="description" class="form-label fw-bold">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Describe your product..." required>{{ old('description') }}</textarea>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="price" class="form-label fw-bold">Price ($)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" placeholder="0.00" required>
                                            </div>
                                        </div>
                                        
                                        <!-- Removed Stock Quantity section -->
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <label for="category_id" class="form-label fw-bold">Category</label>
                                            <select class="form-select" id="category_id" name="category_id" required>
                                                <option value="">Select a category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="color" class="form-label fw-bold">Color</label>
                                            <select class="form-select" id="color" name="color" required>
                                                <option value="">Select a color</option>
                                                @foreach($colors as $color)
                                                    <option value="{{ $color }}" {{ old('color') == $color ? 'selected' : '' }}>
                                                        {{ ucfirst($color) }}
                                                    </option>
                                                @endforeach
                                                <option value="other">Other</option>
                                            </select>
                                            <div id="custom-color-container" class="mt-2 d-none">
                                                <input type="text" class="form-control" id="custom-color" placeholder="Enter color name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Column -->
                                <div class="col-md-5">
                                    <div class="mb-4">
                                        <label for="image" class="form-label fw-bold">Product Image</label>
                                        <div class="card bg-light">
                                            <div class="card-body text-center py-5" id="upload-area">
                                                <i class="bi bi-cloud-arrow-up text-primary fs-1"></i>
                                                <p class="mb-2">Drag and drop or click to upload</p>
                                                <small class="text-muted">JPEG, PNG, JPG, GIF - max 2MB</small>
                                                <input type="file" class="form-control opacity-0 position-absolute top-0 start-0 w-100 h-100" 
                                                    id="image" name="image" accept="image/*" required>
                                            </div>
                                            <div id="image-preview" class="card-body p-2 d-none">
                                                <img id="preview-img" src="#" alt="Preview" class="preview-image w-100">
                                                <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="remove-image">
                                                    <i class="bi bi-trash"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">Available Sizes</label>
                                        <div class="d-flex flex-wrap gap-2">
                                            @php
                                                $commonSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
                                            @endphp
                                            
                                            @foreach($commonSizes as $size)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sizes[]" 
                                                        id="size-{{ $size }}" value="{{ $size }}"
                                                        {{ is_array(old('sizes')) && in_array($size, old('sizes')) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="size-{{ $size }}">{{ $size }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">Feature this product on homepage</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('products.index') }}" class="btn btn-light">
                                    <i class="bi bi-x-lg me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-plus-lg me-1"></i> Create Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Image preview functionality
        document.getElementById('image').addEventListener('change', function() {
            const preview = document.getElementById('preview-img');
            const previewContainer = document.getElementById('image-preview');
            const uploadArea = document.getElementById('upload-area');
            const file = this.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                    uploadArea.classList.add('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('d-none');
                uploadArea.classList.remove('d-none');
            }
        });
        
        // Remove image button functionality
        document.getElementById('remove-image').addEventListener('click', function() {
            const fileInput = document.getElementById('image');
            const previewContainer = document.getElementById('image-preview');
            const uploadArea = document.getElementById('upload-area');
            
            fileInput.value = '';
            previewContainer.classList.add('d-none');
            uploadArea.classList.remove('d-none');
        });
        
        // Handle custom color input
        document.getElementById('color').addEventListener('change', function() {
            const customColorContainer = document.getElementById('custom-color-container');
            const customColorInput = document.getElementById('custom-color');
            
            if (this.value === 'other') {
                customColorContainer.classList.remove('d-none');
                customColorInput.setAttribute('name', 'color');
                this.removeAttribute('name');
            } else {
                customColorContainer.classList.add('d-none');
                customColorInput.removeAttribute('name');
                this.setAttribute('name', 'color');
            }
        });
    </script>
</body>
</html>