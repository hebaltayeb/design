@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Product Details</h4>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-round ml-auto mr-2">
                                <i class="fa fa-arrow-left"></i> Back to List
                            </a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-round">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-image text-center mb-3">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-height: 300px;">
                                    @else
                                        <div class="alert alert-warning">No image available</div>
                                    @endif
                                </div>
                                
                                <div class="card mt-3">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Product Metrics</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Favorites Count
                                                <span class="badge badge-primary badge-pill">{{ $product->favorites_count }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Sales Count
                                                <span class="badge badge-primary badge-pill">{{ $product->sales_count }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                Featured
                                                <span class="badge badge-{{ $product->is_featured ? 'success' : 'secondary' }} badge-pill">
                                                    {{ $product->is_featured ? 'Yes' : 'No' }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="product-details">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="30%">ID</th>
                                                <td>{{ $product->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $product->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Designer</th>
                                                <td>
                                                    @if($product->designer)
                                                        <a href="{{ route('admin.designers.show', $product->designer_id) }}">
                                                            {{ $product->designer->name }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Unknown</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <td>${{ number_format($product->price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Color</th>
                                                <td>{{ $product->color ?: 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Category</th>
                                                <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>
                                                    <span class="badge badge-{{ 
                                                        $product->approval_status === 'approved' ? 'success' : 
                                                        ($product->approval_status === 'pending' ? 'warning' : 
                                                        ($product->approval_status === 'rejected' ? 'danger' : 'secondary')) 
                                                    }}">
                                                        {{ ucfirst($product->approval_status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Created At</th>
                                                <td>{{ $product->created_at->format('M d, Y H:i:s') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Updated At</th>
                                                <td>{{ $product->updated_at ? $product->updated_at->format('M d, Y H:i:s') : 'Never' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h5 class="mb-0">Description</h5>
                                        </div>
                                        <div class="card-body">
                                            {!! $product->description ?: '<em>No description provided</em>' !!}
                                        </div>
                                    </div>
                                    
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h5 class="mb-0">SEO Information</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>SEO Title</label>
                                                <p>{{ $product->seo_title ?: 'Not set' }}</p>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>SEO Description</label>
                                                <p class="mb-0">{{ $product->seo_description ?: 'Not set' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa fa-trash"></i> Delete Product
                            </button>
                            
                            <div>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-default">
                                    <i class="fa fa-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete product: <strong>{{ $product->name }}</strong>?<br>
                This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection