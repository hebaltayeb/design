@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-[#ffd1dc] to-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Category Details: {{ $category->name }}</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                            Edit Category
                        </a>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Back to Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Details -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Category Name</h2>
                        <p class="mt-1 text-lg font-semibold text-gray-900">{{ $category->name }}</p>
                    </div>
                    
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Type</h2>
                        <span class="mt-1 inline-flex px-2 py-1 text-sm font-semibold rounded-full
                            {{ $category->type === 'women' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                            {{ ucfirst($category->type) }}
                        </span>
                    </div>
                    
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Created At</h2>
                        <p class="mt-1 text-md text-gray-900">{{ $category->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products in this Category -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Products in this Category</h2>
                
                @if($category->products->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Designer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($category->products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12">
                                                @if($product->image)
                                                    <img class="h-12 w-12 rounded object-cover" 
                                                         src="{{ asset('storage/' . $product->image) }}" 
                                                         alt="{{ $product->name }}">
                                                @else
                                                    <div class="h-12 w-12 rounded bg-gray-200 flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $product->name }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    SKU: {{ $product->sku ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            ${{ number_format($product->price, 2) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $product->designer->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('admin.products.show', $product) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 mx-1">
                                            View
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="text-blue-600 hover:text-blue-900 mx-1">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-lg">No products in this category yet.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Danger Zone -->
        <div class="mt-6 bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h2>
                <p class="text-sm text-gray-500 mb-4">Deleting this category will remove it from the system. This action cannot be undone.</p>
                
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Delete Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection