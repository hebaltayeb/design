@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen">
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Welcome back, Anas</h1>
            <p class="text-gray-600">Here's what's happening with your fashion business today.</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="relative overflow-hidden bg-gradient-to-br from-black to-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-custom-pink opacity-20 rounded-bl-full"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-custom-pink text-black rounded-xl mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Total Users</p>
                            <div class="flex items-end">
                                <p class="text-2xl font-bold text-white">{{ $totalUsers }}</p>
                                <span class="ml-2 text-xs text-green-400 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>12%
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-700">
                        <a href="#" class="text-xs text-custom-pink hover:text-white flex items-center">
                            View details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden bg-gradient-to-br from-black to-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-custom-pink opacity-20 rounded-bl-full"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-custom-pink text-black rounded-xl mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-paint-brush fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Designers</p>
                            <div class="flex items-end">
                                <p class="text-2xl font-bold text-white">{{ $totalDesigners }}</p>
                                <span class="ml-2 text-xs text-green-400 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>5%
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-700">
                        <a href="#" class="text-xs text-custom-pink hover:text-white flex items-center">
                            View details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden bg-gradient-to-br from-black to-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-custom-pink opacity-20 rounded-bl-full"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-custom-pink text-black rounded-xl mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-shopping-cart fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Orders</p>
                            <div class="flex items-end">
                                <p class="text-2xl font-bold text-white">{{ $totalOrders }}</p>
                                <span class="ml-2 text-xs text-green-400 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>18%
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-700">
                        <a href="#" class="text-xs text-custom-pink hover:text-white flex items-center">
                            View details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative overflow-hidden bg-gradient-to-br from-black to-gray-800 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="absolute right-0 top-0 w-20 h-20 bg-custom-pink opacity-20 rounded-bl-full"></div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-custom-pink text-black rounded-xl mr-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-box fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-300">Products</p>
                            <div class="flex items-end">
                                <p class="text-2xl font-bold text-white">{{ $totalProducts }}</p>
                                <span class="ml-2 text-xs text-green-400 flex items-center">
                                    <i class="fas fa-arrow-up mr-1"></i>7%
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-700">
                        <a href="#" class="text-xs text-custom-pink hover:text-white flex items-center">
                            View details <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">>
            <div class="bg-black text-white px-6 py-4 border-l-4 border-custom-pink flex justify-between items-center">
                <h2 class="text-lg font-semibold">Sales Overview</h2>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-gray-800 hover:bg-gray-700 rounded-lg">Weekly</button>
                    <button class="px-3 py-1 text-xs bg-custom-pink text-black rounded-lg">Monthly</button>
                    <button class="px-3 py-1 text-xs bg-gray-800 hover:bg-gray-700 rounded-lg">Yearly</button>
                </div>
            </div>
            <div class="p-6">
                <div class="h-80 bg-white rounded-lg flex items-center justify-center">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Orders and Users Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-black text-white px-6 py-4 border-l-4 border-custom-pink flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Recent Orders</h2>
                    <a href="#" class="text-xs text-custom-pink hover:text-white flex items-center">
                        View all <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left">Order ID</th>
                                    <th class="px-4 py-2 text-left">Customer</th>
                                    <th class="px-4 py-2 text-left">Date</th>
                                    <th class="px-4 py-2 text-left">Total</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium">#{{ $order->id }}</td>
                                    <td class="px-4 py-3">{{ $order->user->name }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-3 font-medium">${{ number_format($order->total_price, 2) }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-3 text-center text-gray-500">No recent orders</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-black text-white px-6 py-4 border-l-4 border-custom-pink flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Recent Users</h2>
                    <a href="#" class="text-xs text-custom-pink hover:text-white flex items-center">
                        View all <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left">User</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Joined</th>
                                    <th class="px-4 py-2 text-left">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentUsers as $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center">
                                            <img class="w-8 h-8 rounded-full mr-3" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="{{ $user->name }}">
                                            <span>{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                                    <td class="px-4 py-3 text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Customer</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">No recent users</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-black text-white px-6 py-4 border-l-4 border-custom-pink flex justify-between items-center">
                <h2 class="text-lg font-semibold">Top Products</h2>
                <a href="#" class="text-xs text-custom-pink hover:text-white flex items-center">
                    View all <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left">Product</th>
                                <th class="px-4 py-2 text-left">Category</th>
                                <th class="px-4 py-2 text-left">Price</th>
                                <th class="px-4 py-2 text-left">Sales</th>
                                <th class="px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topProducts as $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-tshirt text-gray-500"></i>
                                        </div>
                                        <span class="font-medium">{{ $product->name }}</span>
                                    </div>
                                </td>
                                 
                                <td class="px-4 py-3 font-medium">${{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <span class="mr-2">{{ $product->sales_count }}</span>
                                        <div class="w-24 h-2 bg-gray-200 rounded-full overflow-hidden">
                                            <div class="h-full bg-custom-pink" style="width: {{ min(($product->sales_count / 100) * 100, 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">In Stock</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500">No products found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample data for the chart (replace with real data)
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const salesData = [5000, 7800, 6500, 8200, 9500, 10200, 9800, 11500, 12800, 13500, 14200, 15000];
        
        // Set up the sales chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Sales ($)',
                    data: salesData,
                    backgroundColor: 'rgba(255, 209, 220, 0.3)',
                    borderColor: '#ffd1dc',
                    borderWidth: 3,
                    pointBackgroundColor: '#000',
                    pointBorderColor: '#ffd1dc',
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#ffd1dc',
                    pointHoverBorderColor: '#000',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#000',
                        titleColor: '#ffd1dc',
                        bodyColor: '#fff',
                        padding: 12,
                        borderColor: '#ffd1dc',
                        borderWidth: 1,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return '$ ' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Make first sidebar item active by default (Dashboard)
        document.addEventListener('DOMContentLoaded', function() {
            const firstSidebarItem = document.querySelector('.sidebar-item');
            if (firstSidebarItem) {
                firstSidebarItem.classList.add('active');
            }
        });
    </script>
@endsection