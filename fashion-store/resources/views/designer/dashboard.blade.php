@extends('layouts.designer.layout')

@section('title', 'Designer Dashboard')

@section('content')
<!-- Replace React/Recharts with Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-4">
                <li>
                    <a href="/" class="text-gray-500 hover:text-pink-500 transition-colors">Home</a>
                </li>
                <li>
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="text-gray-900">Designer Dashboard</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Profile Section -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <!-- Banner -->
        <div class="h-48 bg-gradient-to-r from-pink-400 to-purple-500 relative">
            <img src="/api/placeholder/1200/200" alt="Banner" class="w-full h-full object-cover">
            <button class="absolute bottom-4 right-4 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-colors">
                <i class="fas fa-camera"></i>
            </button>
        </div>
        
        <!-- Profile Info -->
        <div class="px-6 pb-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 relative">
                <div class="relative">
                    <img src="/api/placeholder/120/120" alt="Profile" class="w-32 h-32 rounded-full border-4 border-white shadow-lg">
                    <button class="absolute bottom-2 right-2 bg-pink-500 text-white p-2 rounded-full hover:bg-pink-600 transition-colors">
                        <i class="fas fa-camera text-sm"></i>
                    </button>
                </div>
                
                <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ auth()->user()->name ?? 'Designer Name' }}</h1>
                    <p class="text-gray-600 mb-4">Fashion Designer</p>
                    <p class="text-gray-500 max-w-md">Passionate fashion designer dedicated to creating elegant and timeless pieces.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="mb-8">
        <nav class="flex space-x-8 border-b border-gray-200">
            <button onclick="switchTab('dashboard')" class="tab-button py-2 px-1 border-b-2 font-medium text-sm border-pink-500 text-pink-600">
                <i class="fas fa-chart-line mr-2"></i>Dashboard
            </button>
            <button onclick="switchTab('products')" class="tab-button py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <i class="fas fa-tshirt mr-2"></i>Products
            </button>
            <button onclick="switchTab('courses')" class="tab-button py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <i class="fas fa-graduation-cap mr-2"></i>Courses
            </button>
            <button onclick="switchTab('orders')" class="tab-button py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <i class="fas fa-shopping-bag mr-2"></i>Orders
            </button>
            <button onclick="switchTab('settings')" class="tab-button py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <i class="fas fa-cog mr-2"></i>Settings
            </button>
        </nav>
    </div>

    <!-- Tab Contents -->
    @include('designer.tabs.dashboard', ['analyticsData' => $analyticsData])

    @php
        $products = $products ?? auth()->user()->products()->orderBy('created_at', 'desc')->get();
        $courses = $courses ?? auth()->user()->courses()->orderBy('created_at', 'desc')->get();
        $orders = $orders ?? auth()->user()->designerOrders()->with(['user', 'orderItems.product'])->orderBy('created_at', 'desc')->get();
    @endphp
    @include('designer.tabs.products', compact('products'))
    @include('designer.tabs.courses', compact('courses'))
    @include('designer.tabs.orders', compact('orders'))
    @include('designer.tabs.settings')
</div>

<!-- Modals -->
@include('designer.modals.product')
@include('designer.modals.course')

<!-- Chart.js Implementation -->
<script>
// Analytics data from Laravel
const analyticsData = @json($analyticsData ?? []);
console.log('Analytics Data:', analyticsData);

// Chart instances to destroy when switching tabs
let chartInstances = {};

// Color palette
const COLORS = {
    primary: '#ec4899',
    secondary: '#8b5cf6',
    accent: '#06b6d4',
    success: '#10b981',
    warning: '#f59e0b',
    danger: '#ef4444'
};

// Chart.js default configuration
Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
Chart.defaults.color = '#6b7280';

// Sales Chart
function createSalesChart() {
    const ctx = document.getElementById('sales-chart');
    if (!ctx || !analyticsData.sales) return;
    
    if (chartInstances.sales) {
        chartInstances.sales.destroy();
    }
    
    chartInstances.sales = new Chart(ctx, {
        type: 'line',
        data: {
            labels: analyticsData.sales.map(item => item.date),
            datasets: [{
                label: 'Sales',
                data: analyticsData.sales.map(item => item.sales),
                borderColor: COLORS.primary,
                backgroundColor: COLORS.primary + '20',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6'
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
}

// Revenue Chart
function createRevenueChart() {
    const ctx = document.getElementById('revenue-chart');
    if (!ctx || !analyticsData.revenue) return;
    
    if (chartInstances.revenue) {
        chartInstances.revenue.destroy();
    }
    
    chartInstances.revenue = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: analyticsData.revenue.map(item => item.month),
            datasets: [
                {
                    label: 'Products',
                    data: analyticsData.revenue.map(item => item.products),
                    backgroundColor: COLORS.primary,
                    borderRadius: 4
                },
                {
                    label: 'Courses',
                    data: analyticsData.revenue.map(item => item.courses),
                    backgroundColor: COLORS.secondary,
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6'
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
}

// Product Performance Chart
function createProductChart() {
    const ctx = document.getElementById('product-chart');
    if (!ctx || !analyticsData.products) return;
    
    if (chartInstances.products) {
        chartInstances.products.destroy();
    }
    
    chartInstances.products = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: analyticsData.products.map(item => item.name),
            datasets: [{
                label: 'Sales',
                data: analyticsData.products.map(item => item.sales),
                backgroundColor: COLORS.accent,
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6'
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

// Category Distribution Chart
function createCategoryChart() {
    const ctx = document.getElementById('category-chart');
    if (!ctx || !analyticsData.categories) return;
    
    if (chartInstances.categories) {
        chartInstances.categories.destroy();
    }
    
    const colors = [COLORS.primary, COLORS.secondary, COLORS.accent, COLORS.success, COLORS.warning, COLORS.danger];
    
    chartInstances.categories = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: analyticsData.categories.map(item => item.name),
            datasets: [{
                data: analyticsData.categories.map(item => item.value),
                backgroundColor: colors.slice(0, analyticsData.categories.length),
                borderWidth: 0,
                cutout: '60%'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
}

// Function to load all charts
function loadDashboardCharts() {
    console.log('Loading dashboard charts...');
    
    if (!analyticsData || Object.keys(analyticsData).length === 0) {
        console.warn('No analytics data available');
        return;
    }

    setTimeout(() => {
        createSalesChart();
        createRevenueChart();
        createProductChart();
        createCategoryChart();
    }, 100);
}

// Tab navigation functionality
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-pink-500', 'text-pink-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    const tabContent = document.getElementById(tabName + '-tab');
    if (tabContent) {
        tabContent.classList.remove('hidden');
    }
    
    // Add active class to clicked tab button
    event.target.classList.remove('border-transparent', 'text-gray-500');
    event.target.classList.add('border-pink-500', 'text-pink-600');
    
    // Load charts when dashboard tab is active
    if (tabName === 'dashboard') {
        loadDashboardCharts();
    }
}

// Load charts on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, loading charts...');
    loadDashboardCharts();
});

// Handle window resize
window.addEventListener('resize', function() {
    Object.values(chartInstances).forEach(chart => {
        if (chart) {
            chart.resize();
        }
    });
});
</script>
@endsection