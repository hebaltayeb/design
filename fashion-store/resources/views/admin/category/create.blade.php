@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-[#ffd1dc] to-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Create New Category</h1>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Back to Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6">
                @csrf
                
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Type -->
                <div class="mb-6">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select name="type" id="type" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50"
                            required>
                        <option value="" disabled selected>Select type</option>
                        <option value="women" {{ old('type') == 'women' ? 'selected' : '' }}>Women</option>
                        <option value="designer" {{ old('type') == 'designer' ? 'selected' : '' }}>Designer</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection