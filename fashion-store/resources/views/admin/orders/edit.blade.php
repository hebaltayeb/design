@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="p-6 bg-gradient-to-r from-[#ffd1dc] to-white">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Edit Order #{{ $order->id }}</h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.orders.show', $order) }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            View Details
                        </a>
                        <a href="{{ route('admin.orders.index') }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                            Back to Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Edit Form -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center mb-6">
                    <div class="flex-shrink-0 h-12 w-12">
                        @if ($order->user->profile_picture)
                            <img class="h-12 w-12 rounded-full object-cover" 
                                 src="{{ asset('storage/' . $order->user->profile_picture) }}" 
                                 alt="{{ $order->user->name }}">
                        @else
                            <div class="h-12 w-12 rounded-full bg-[#ffd1dc] flex items-center justify-center">
                                <span class="text-xl font-medium text-gray-700">
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            Order for {{ $order->user->name }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            Placed on {{ $order->created_at->format('F d, Y h:i A') }}
                        </p>
                    </div>
                </div>
                
                <div class="border-t border-b border-gray-200 py-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <div class="text-sm text-gray-500">Total Amount</div>
                            <div class="text-xl font-bold text-gray-900">${{ number_format($order->total_price, 2) }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Items</div>
                            <div class="font-medium text-gray-900">{{ $order->orderItems->sum('quantity') }} items</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Current Status</div>
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
                    </div>
                </div>
                
                <!-- Update Status Form -->
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Update Order Status</label>
                        <select name="status" id="status" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#ffd1dc] focus:ring focus:ring-[#ffd1dc] focus:ring-opacity-50">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $status === $order->status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Order Items Summary (Read-only) -->
                    <div class="mb-6">
                        <h3 class="text-md font-medium text-gray-700 mb-3">Order Items</h3>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Product
                                            </th>
                                            <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Size
                                            </th>
                                            <th scope="col" class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Qty
                                            </th>
                                            <th scope="col" class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Price
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900">
                                                {{ $item->product ? $item->product->name : 'Product Unavailable' }}
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ $item->size }}
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500 text-center">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-900 text-right">
                                                ${{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                            Update Order Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection