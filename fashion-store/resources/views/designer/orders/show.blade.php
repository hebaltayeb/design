@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
            </div>
            <a href="{{ route('designer.orders.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                ← Back to Orders
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Customer Information</h3>
                <div class="space-y-2">
                    <p><span class="font-medium">Name:</span> {{ $order->user->name }}</p>
                    <p><span class="font-medium">Email:</span> {{ $order->user->email }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>
                <div class="space-y-4">
                    @foreach($order->orderItems as $item)
                        <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900">{{ $item->product->name }}</h4>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <p>Size: {{ $item->size }}</p>
                                    <p>Quantity: {{ $item->quantity }}</p>
                                    <p>Price: ${{ number_format($item->price, 2) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-900">
                                    ${{ number_format($item->price * $item->quantity, 2) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Order Summary & Status -->
        <div class="space-y-6">
            <!-- Order Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span>Subtotal</span>
                        <span>${{ number_format($order->total_price, 2) }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-3">
                        <div class="flex justify-between font-medium text-gray-900">
                            <span>Total</span>
                            <span>${{ number_format($order->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Update -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status</h3>
                
                <div class="mb-4">
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                        @switch($order->status)
                            @case('pending')
                                bg-yellow-100 text-yellow-800
                                @break
                            @case('processing')
                                bg-blue-100 text-blue-800
                                @break
                            @case('shipped')
                                bg-purple-100 text-purple-800
                                @break
                            @case('delivered')
                                bg-green-100 text-green-800
                                @break
                            @case('cancelled')
                                bg-red-100 text-red-800
                                @break
                            @default
                                bg-gray-100 text-gray-800
                        @endswitch">
                        Current: {{ ucfirst($order->status) }}
                    </span>
                </div>

                <form action="{{ route('designer.orders.update-status', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            New Status
                        </label>
                        <select name="status" id="status" 
                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" 
                            class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection