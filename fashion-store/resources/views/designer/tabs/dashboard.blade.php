<div class="tab-content" id="dashboard-tab">
    <!-- Analytics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-pink-100 rounded-lg">
                    <i class="fas fa-dollar-sign text-pink-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($analyticsData['total_revenue'] ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <i class="fas fa-shopping-bag text-blue-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Sales</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($analyticsData['total_sales'] ?? 0) }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <i class="fas fa-tshirt text-green-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Products</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $analyticsData['total_products'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <i class="fas fa-graduation-cap text-purple-600"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Courses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $analyticsData['total_courses'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Sales Trend Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Sales Trend</h3>
            <div class="h-64">
                <canvas id="sales-chart"></canvas>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Monthly Revenue</h3>
            <div class="h-64">
                <canvas id="revenue-chart"></canvas>
            </div>
        </div>

        <!-- Product Performance -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Top Products</h3>
            <div class="h-64">
                <canvas id="product-chart"></canvas>
            </div>
        </div>

        <!-- Category Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Category Distribution</h3>
            <div class="h-64">
                <canvas id="category-chart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($analyticsData['recent_activities'] ?? [] as $activity)
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-gray-100 rounded-full">
                            <i class="fas fa-{{ $activity['icon'] ?? 'info' }} text-gray-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-900">{{ $activity['message'] }}</p>
                            <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-clock text-gray-300 text-3xl mb-2"></i>
                        <p class="text-gray-500">No recent activity</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Stats Table -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Performance Overview</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metric</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">This Month</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Month</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Change</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Products Sold</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ rand(15, 35) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ rand(10, 30) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">+{{ rand(5, 15) }}%</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Course Enrollments</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ rand(8, 20) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ rand(5, 15) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">+{{ rand(10, 25) }}%</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Total Revenue</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format(rand(1500, 3000), 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format(rand(1200, 2500), 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600">+{{ rand(8, 20) }}%</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>