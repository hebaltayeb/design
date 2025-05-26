@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-[#ffd1dc] to-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Create New User</h1>
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Back to Users
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
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
                
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50"
                           required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Confirmation -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50"
                           required>
                </div>
                
                <!-- Role -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="role" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="designer" {{ old('role') == 'designer' ? 'selected' : '' }}>Designer</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Is Designer -->
                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_designer" id="is_designer" value="1" 
                               {{ old('is_designer') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#ffd1dc] focus:ring-[#ffd1dc]">
                        <label for="is_designer" class="ml-2 block text-sm text-gray-700">
                            Is Designer
                        </label>
                    </div>
                    @error('is_designer')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Bio -->
                <div class="mb-4">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                    <textarea name="bio" id="bio" rows="4" 
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50">{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Profile Picture -->
                <div class="mb-6">
                    <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>
                    <input type="file" name="profile_picture" id="profile_picture" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50">
                    @error('profile_picture')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection