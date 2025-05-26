@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-[#ffd1dc] to-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">User Details</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                            Edit User
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Back to Users
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Details -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex flex-col md:flex-row">
                    <!-- User Avatar & Basic Info -->
                    <div class="md:w-1/3 flex flex-col items-center p-4">
                        <div class="w-32 h-32 mb-4">
                            @if ($user->profile_picture)
                            <img class="w-full h-full rounded-full object-cover border-4 border-[#ffd1dc]"
                                src="{{ asset('storage/' . $user->profile_picture) }}"
                                alt="{{ $user->name }}">
                            @else
                            <div class="w-full h-full rounded-full bg-[#ffd1dc] flex items-center justify-center border-4 border-[#ffd1dc]">
                                <span class="text-3xl font-bold text-gray-700">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                            @endif
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-500">{{ $user->email }}</p>

                        <div class="mt-4 flex flex-wrap justify-center gap-2">
                            <span class="px-3 py-1 rounded-full text-sm 
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 
                                   ($user->role === 'super_admin' ? 'bg-red-100 text-red-800' : 
                                    'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst($user->role) }}
                            </span>

                            @if ($user->is_designer)
                            <span class="px-3 py-1 rounded-full text-sm bg-[#ffd1dc] text-gray-800">
                                Designer
                            </span>
                            @endif
                        </div>

                        <div class="mt-6 text-sm text-gray-500">
                            <div class="mb-1">Joined: {{ $user->created_at->format('F d, Y') }}</div>
                            @if ($user->email_verified_at)
                            <div class="mb-1">Verified: {{ $user->email_verified_at->format('F d, Y') }}</div>
                            @else
                            <div class="mb-1 text-orange-500">Email not verified</div>
                            @endif
                        </div>
                    </div>

                    <!-- User Details -->
                    <div class="md:w-2/3 p-4">
                        <!-- Bio -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 border-b border-gray-200 pb-1">Biography</h3>
                            <div class="text-gray-700">
                                {!! $user->bio ? nl2br(e($user->bio)) : '<em class="text-gray-400">No biography provided</em>' !!}
                            </div>
                        </div>

                        <!-- Statistics -->
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 border-b border-gray-200 pb-1">User Activity</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            @if ($user->is_designer)
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Products Created</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $user->products->count() }}</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Courses Created</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $user->courses->count() }}</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Events Created</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $user->events->count() }}</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Media Gallery Items</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $user->mediaItems->count() }}</div>
                            </div>
                            @endif

                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Favorites</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $user->favorites->count() }}</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Course Enrollments</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $user->enrollments->count() }}</div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Customization Requests</div>
                                <div class="text-2xl font-bold text-gray-900">{{ $user->customizationRequests->count() }}</div>
                            </div>
                        </div>

                        <!-- Danger Zone -->
                        <div class="mt-10 p-4 bg-red-50 rounded-lg border border-red-100">
                            <h3 class="text-lg font-semibold text-red-700 mb-2">Danger Zone</h3>
                            <p class="text-sm text-red-600 mb-4">Deleting this user will remove all of their data. This action cannot be undone.</p>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    Delete User Account
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection