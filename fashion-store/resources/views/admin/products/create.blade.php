@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Create New Product</h4>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Add Product</h4>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-round ml-auto">
                                <i class="fa fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="designer_id">Designer</label>
                                        <select class="form-control" id="designer_id" name="designer_id">
                                            <option value="">Select Designer</option>
                                            @foreach($designers as $designer)
                                            <option value="{{ $designer->id }}" {{ old('designer_id') == $designer->id ? 'selected' : '' }}>
                                                {{ $designer->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Optional: You can assign a designer later</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Price <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="color">Color</label>
                                        <input type="text" class="form-control" id="color" name="color" value="{{ old('color') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select class="form-control" id="category_id" name="category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Optional: You can categorize this product later</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="approval_status">Approval Status</label>
                                        <select class="form-control" id="approval_status" name="approval_status">
                                            <option value="pending" {{ old('approval_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ old('approval_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ old('approval_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            <option value="canceled" {{ old('approval_status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Product Image</label>
                                        <input type="file" class="form-control-file" id="image" name="image">
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_featured">Featured Product</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seo_title">SEO Title</label>
                                        <input type="text" class="form-control" id="seo_title" name="seo_title" value="{{ old('seo_title') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="seo_description">SEO Description</label>
                                        <textarea class="form-control" id="seo_description" name="seo_description" rows="2">{{ old('seo_description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button type="submit" class="btn btn-primary">Create Product</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize rich text editor for description
        if (typeof CKEDITOR !== 'undefined') {
            CKEDITOR.replace('description');
        }
    });
</script>
@endpush