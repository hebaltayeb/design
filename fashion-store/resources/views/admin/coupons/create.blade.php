@extends('layouts.admin')

@section('title', 'Create Coupon')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">Create New Coupon</h1>
        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> Back to Coupons
        </a>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-tag me-1"></i>
            Coupon Details
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.store') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="code" class="block text-sm font-medium text-gray-700">Coupon Code *</label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}" 
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('code') border-red-300 @enderror"
                        required maxlength="50">
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Enter a unique code for this coupon.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="discount_value" class="block text-sm font-medium text-gray-700">Discount Value *</label>
                        <input type="number" name="discount_value" id="discount_value" value="{{ old('discount_value') }}" 
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('discount_value') border-red-300 @enderror"
                            required step="0.01" min="0">
                        @error('discount_value')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="is_percentage" class="block text-sm font-medium text-gray-700">Discount Type *</label>
                        <select name="is_percentage" id="is_percentage" 
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('is_percentage') border-red-300 @enderror"
                            required>
                            <option value="1" {{ old('is_percentage') == '1' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="0" {{ old('is_percentage') == '0' ? 'selected' : '' }}>Fixed Amount ($)</option>
                        </select>
                        @error('is_percentage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="valid_from" class="block text-sm font-medium text-gray-700">Valid From *</label>
                        <input type="date" name="valid_from" id="valid_from" value="{{ old('valid_from', now()->format('Y-m-d')) }}" 
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('valid_from') border-red-300 @enderror"
                            required>
                        @error('valid_from')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="valid_to" class="block text-sm font-medium text-gray-700">Valid To *</label>
                        <input type="date" name="valid_to" id="valid_to" value="{{ old('valid_to', now()->addMonths(1)->format('Y-m-d')) }}" 
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('valid_to') border-red-300 @enderror"
                            required>
                        @error('valid_to')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Coupon
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection