@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-[#ffd1dc] to-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.orders.edit', $order) }}" 
                           class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                            Edit Status
                        </a>
                        <a href="{{ route('admin.orders.index') }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden h-full">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Order Summary</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <div class="text-sm text-gray-500">Status</div>
                                <div class="mt-1">
                                    <span class="px-2 py-1 rounded-full text-sm font-semibold 
                                        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($order->status === 'processing' ? 'bg-blue-100 text-blue-800' : 
                                            ($order->status === 'shipped' ? 'bg-indigo-100 text-indigo-800' : 
                                             ($order->status === 'delivered' ? 'bg-green-100 text-green-800' : 
                                              'bg-red-100 text-red-800'))) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div>
                                <div class="text-sm text-gray-500">Order Date</div>
                                <div class="font-medium text-gray-900">{{ $order->created_at->format('F d, Y h:i A') }}</div>
                            </div>
                            
                            <div>
                                <div class="text-sm text-gray-500">Total Amount</div>
                                <div class="text-xl font-bold text-gray-900">${{ number_format($order->total_price, 2) }}</div>
                            </div>
                            
                            <div>
                                <div class="text-sm text-gray-500">Items</div>
                                <div class="font-medium text-gray-900">{{ $order->orderItems->sum('quantity') }} items</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Customer Information -->
            <div class="lg:col-span-2">
                <div class="bg-white shadow-sm rounded-lg overflow-hidden h-full">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Customer Information</h2>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                @if ($order->user->profile_picture)
                                    <img class="h-16 w-16 rounded-full object-cover" 
                                         src="{{ asset('storage/' . $order->user->profile_picture) }}" 
                                         alt="{{ $order->user->name }}">
                                @else
                                    <div class="h-16 w-16 rounded-full bg-[#ffd1dc] flex items-center justify-center">
                                        <span class="text-2xl font-bold text-gray-700">
                                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="ml-4 space-y-2">
                                <div>
                                    <div class="text-sm text-gray-500">Name</div>
                                    <div class="font-medium text-gray-900">{{ $order->user->name }}</div>
                                </div>
                                
                                <div>
                                    <div class="text-sm text-gray-500">Email</div>
                                    <div class="font-medium text-gray-900">{{ $order->user->email }}</div>
                                </div>
                                
                                <div>
                                    <div class="text-sm text-gray-500">Customer Since</div>
                                    <div class="font-medium text-gray-900">{{ $order->user->created_at->format('F d, Y') }}</div>
                                </div>
                                
                                <div class="pt-2">
                                    <a href="{{ route('admin.users.show', $order->user) }}" 
                                       class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                        View Customer Profile
                                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Items -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Order Items</h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Size
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subtotal
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($order->orderItems as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded">
                                            @if ($item->product && $item->product->image)
                                                <img class="h-16 w-16 object-cover rounded" 
                                                     src="{{ asset('storage/' . $item->product->image) }}" 
                                                     alt="{{ $item->product->name }}">
                                            @else
                                                <div class="h-16 w-16 flex items-center justify-center bg-gray-100 rounded">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                @if ($item->product)
                                                    {{ $item->product->name }}
                                                @else
                                                    Product Unavailable
                                                @endif
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                @if ($item->product)
                                                    SKU: {{ $item->product->sku ?? 'N/A' }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->size }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    {{ $item->quantity }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                    ${{ number_format($item->price, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray-50">
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                    Total:
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-gray-900 text-right">
                                    ${{ number_format($order->total_price, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Danger Zone -->
        <div class="mt-6 bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h2>
                <p class="text-sm text-gray-500 mb-4">Deleting this order will permanently remove it from the system. This action cannot be undone.</p>
                
                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Delete Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection