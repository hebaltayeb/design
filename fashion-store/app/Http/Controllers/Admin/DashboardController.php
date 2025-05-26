<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Summary statistics
        $totalUsers = User::count();
        $totalDesigners = User::where('is_designer', 1)->count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCourses = Course::count();

        // Recent users
        $recentUsers = User::latest()->take(5)->get();
        
        // Recent orders
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Sales over time (last 30 days)
        $salesData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total_sales')
        )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top selling products
        $topProducts = Product::orderBy('sales_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDesigners',
            'totalProducts',
            'totalOrders',
            'totalCourses',
            'recentUsers',
            'recentOrders',
            'salesData',
            'topProducts'
        ));
    }
}