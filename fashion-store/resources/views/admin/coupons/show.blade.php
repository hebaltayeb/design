@extends('layouts.admin')

@section('title', 'Coupon Details')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Coupon Details</h1>
        <div>
            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit me-1"></i> Edit Coupon
            </a>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Coupons
            </a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header bg-gray-50">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-tag text-gray-500 mr-2"></i>
                    <span class="text-lg font-semibold">{{ $coupon->code }}</span>
                </div>
                <div>
                    @if($coupon->isValid())
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Active
                        </span>
                    @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Inactive
                        </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Coupon Information</h2>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <span class="w-32 text-sm font-medium text-gray-500">Code:</span>
                            <span class="text-lg font-medium text-indigo-600 bg-indigo-50 px-3 py-1 rounded">{{ $coupon->code }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-32 text-sm font-medium text-gray-500">Discount:</span>
                            <span class="text-lg font-medium">
                                @if($coupon->is_percentage)
                                    <span class="text-green-600">{{ $coupon->discount_value }}%</span> off
                                @else
                                    <span class="text-green-600">${{ number_format($coupon->discount_value, 2) }}</span> off
                                @endif
                            </span>
                        </li>
                        <li class="flex items-center">
                            <span class="w-32 text-sm font-medium text-gray-500">Type:</span>
                            <span>{{ $coupon->is_percentage ? 'Percentage discount' : 'Fixed amount discount' }}</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Validity Period</h2>
                    <div class="flex flex-col space-y-4">
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Valid From:</span>
                            <span class="text-lg">{{ $coupon->valid_from->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Valid To:</span>
                            <span class="text-lg">{{ $coupon->valid_to->format('M d, Y') }}</span>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-500">Status:</span>
                            @if($coupon->isValid())
                                <div class="mt-1 flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                    <span>Currently active</span>
                                </div>
                            @else
                                <div class="mt-1 flex items-center">
                                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                    <span>Not active</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 p-6 bg-white rounded-lg shadow-sm border border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Date Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Created:</span>
                        <span>{{ $coupon->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-gray-500">Last Updated:</span>
                        <span>{{ $coupon->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-gray-50 px-6 py-3">
            <div class="flex justify-between items-center">
                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" 
                    onsubmit="return confirm('Are you sure you want to delete this coupon? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i> Delete Coupon
                    </button>
                </form>
                
                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    <i class="fas fa-edit mr-2"></i> Edit Details
                </a>
            </div>
        </div>
    </div>
</div>
@endsection