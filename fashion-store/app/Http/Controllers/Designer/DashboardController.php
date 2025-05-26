<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $designer = Auth::user();
        $products = $designer->products()->orderBy('created_at', 'desc')->get();
        $courses = $designer->courses()->orderBy('created_at', 'desc')->get();
        
        // Get analytics data
        $analyticsData = $this->getAnalyticsData($designer);
        
        return view('designer.dashboard', compact('products', 'courses', 'analyticsData'));
    }

    private function getAnalyticsData($designer)
    {
        // Get actual counts from database
        $totalProducts = $designer->products()->count();
        $totalCourses = $designer->courses()->count();
        
        // Get actual sales data from orders
        $productSales = $this->getActualProductSales($designer);
        
        // Check if enrollments table exists, otherwise use 0
        $courseEnrollments = $this->getCourseEnrollments($designer);
        $totalRevenue = $this->getActualRevenue($designer);

        return [
            // For the summary cards
            'total_revenue' => $totalRevenue,
            'total_sales' => $productSales['total_quantity'],
            'total_products' => $totalProducts,
            'total_courses' => $totalCourses,
            'total_students' => $courseEnrollments,
            
            // For charts - using real data
            'sales' => $this->getRealSalesData($designer),
            'revenue' => $this->getRealRevenueData($designer),
            'products' => $this->getRealProductPerformance($designer),
            'enrollments' => $this->getRealCourseEnrollmentData($designer),
            'categories' => $this->getRealCategoryDistribution($designer),
            
            // Recent activities
            'recent_activities' => $this->getRecentActivities($designer),
            
            // Legacy summary object
            'summary' => [
                'totalProducts' => $totalProducts,
                'totalCourses' => $totalCourses,
                'totalRevenue' => $totalRevenue,
                'totalStudents' => $courseEnrollments
            ]
        ];
    }

    private function getCourseEnrollments($designer)
    {
        // Check if enrollments table exists
        if (Schema::hasTable('enrollments')) {
            try {
                return $designer->courses()->withCount('enrollments')->get()->sum('enrollments_count');
            } catch (\Exception $e) {
                return 0;
            }
        }
        return 0;
    }

    private function getActualProductSales($designer)
    {
        // Check if order_items and orders tables exist
        if (!Schema::hasTable('order_items') || !Schema::hasTable('orders')) {
            return [
                'total_quantity' => 0,
                'total_revenue' => 0
            ];
        }

        try {
            $sales = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->where('products.designer_id', $designer->id)
                ->where('orders.status', 'completed')
                ->select(
                    DB::raw('SUM(order_items.quantity) as total_quantity'),
                    DB::raw('SUM(order_items.price * order_items.quantity) as total_revenue')
                )
                ->first();

            return [
                'total_quantity' => $sales->total_quantity ?? 0,
                'total_revenue' => $sales->total_revenue ?? 0
            ];
        } catch (\Exception $e) {
            return [
                'total_quantity' => 0,
                'total_revenue' => 0
            ];
        }
    }

    private function getActualRevenue($designer)
    {
        $productRevenue = 0;
        $courseRevenue = 0;

        // Product revenue from orders
        if (Schema::hasTable('order_items') && Schema::hasTable('orders')) {
            try {
                $productRevenue = DB::table('order_items')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('products.designer_id', $designer->id)
                    ->where('orders.status', 'completed')
                    ->sum(DB::raw('order_items.price * order_items.quantity'));
            } catch (\Exception $e) {
                $productRevenue = 0;
            }
        }

        // Course revenue from enrollments (if table exists)
        if (Schema::hasTable('enrollments')) {
            try {
                $courseRevenue = DB::table('enrollments')
                    ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                    ->where('courses.designer_id', $designer->id)
                    ->where('enrollments.status', 'active')
                    ->sum('enrollments.amount_paid');
            } catch (\Exception $e) {
                $courseRevenue = 0;
            }
        }

        return ($productRevenue ?? 0) + ($courseRevenue ?? 0);
    }

    private function getRealSalesData($designer)
    {
        $data = [];
        
        if (!Schema::hasTable('order_items') || !Schema::hasTable('orders')) {
            // Return empty data with proper structure
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $data[] = [
                    'date' => $date->format('M d'),
                    'sales' => 0,
                    'revenue' => 0.0
                ];
            }
            return $data;
        }

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            try {
                $sales = DB::table('order_items')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('products.designer_id', $designer->id)
                    ->where('orders.status', 'completed')
                    ->whereDate('orders.created_at', $date->toDateString())
                    ->sum('order_items.quantity');

                $revenue = DB::table('order_items')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('products.designer_id', $designer->id)
                    ->where('orders.status', 'completed')
                    ->whereDate('orders.created_at', $date->toDateString())
                    ->sum(DB::raw('order_items.price * order_items.quantity'));
            } catch (\Exception $e) {
                $sales = 0;
                $revenue = 0;
            }

            $data[] = [
                'date' => $date->format('M d'),
                'sales' => (int)($sales ?? 0),
                'revenue' => (float)($revenue ?? 0)
            ];
        }
        return $data;
    }

    private function getRealRevenueData($designer)
    {
        $data = [];
        
        for ($i = 5; $i >= 0; $i--) {
            $startDate = Carbon::now()->subMonths($i)->startOfMonth();
            $endDate = Carbon::now()->subMonths($i)->endOfMonth();
            
            $productRevenue = 0;
            $courseRevenue = 0;

            // Get actual product revenue for this month
            if (Schema::hasTable('order_items') && Schema::hasTable('orders')) {
                try {
                    $productRevenue = DB::table('order_items')
                        ->join('products', 'order_items.product_id', '=', 'products.id')
                        ->join('orders', 'order_items.order_id', '=', 'orders.id')
                        ->where('products.designer_id', $designer->id)
                        ->where('orders.status', 'completed')
                        ->whereBetween('orders.created_at', [$startDate, $endDate])
                        ->sum(DB::raw('order_items.price * order_items.quantity'));
                } catch (\Exception $e) {
                    $productRevenue = 0;
                }
            }

            // Get actual course revenue for this month (if enrollments table exists)
            if (Schema::hasTable('enrollments')) {
                try {
                    $courseRevenue = DB::table('enrollments')
                        ->join('courses', 'enrollments.course_id', '=', 'courses.id')
                        ->where('courses.designer_id', $designer->id)
                        ->whereBetween('enrollments.created_at', [$startDate, $endDate])
                        ->sum('enrollments.amount_paid');
                } catch (\Exception $e) {
                    $courseRevenue = 0;
                }
            }

            $data[] = [
                'month' => $startDate->format('M Y'),
                'products' => (float)($productRevenue ?? 0),
                'courses' => (float)($courseRevenue ?? 0),
                'total' => (float)(($productRevenue ?? 0) + ($courseRevenue ?? 0))
            ];
        }
        return $data;
    }

    private function getRealProductPerformance($designer)
    {
        if (!Schema::hasTable('order_items') || !Schema::hasTable('orders')) {
            // Return basic product data without sales info
            $products = $designer->products()->take(5)->get();
            return $products->map(function($product) {
                return [
                    'name' => $product->name,
                    'sales' => 0,
                    'revenue' => 0.0,
                    'favorites' => 0
                ];
            })->toArray();
        }

        try {
            $products = DB::table('products')
                ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
                ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
                ->leftJoin('favorites', 'products.id', '=', 'favorites.product_id')
                ->where('products.designer_id', $designer->id)
                ->select(
                    'products.name',
                    'products.price',
                    DB::raw('COALESCE(SUM(CASE WHEN orders.status = "completed" THEN order_items.quantity ELSE 0 END), 0) as sales'),
                    DB::raw('COALESCE(SUM(CASE WHEN orders.status = "completed" THEN order_items.price * order_items.quantity ELSE 0 END), 0) as revenue'),
                    DB::raw('COUNT(DISTINCT favorites.id) as favorites')
                )
                ->groupBy('products.id', 'products.name', 'products.price')
                ->orderBy('sales', 'desc')
                ->take(5)
                ->get();

            if ($products->isEmpty()) {
                return [];
            }

            return $products->map(function($product) {
                return [
                    'name' => $product->name,
                    'sales' => (int)$product->sales,
                    'revenue' => (float)$product->revenue,
                    'favorites' => (int)$product->favorites
                ];
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getRealCourseEnrollmentData($designer)
    {
        if (!Schema::hasTable('enrollments')) {
            // Return basic course data without enrollment info
            $courses = $designer->courses()->take(5)->get();
            return $courses->map(function($course) {
                return [
                    'title' => $course->title,
                    'enrollments' => 0,
                    'revenue' => 0.0
                ];
            })->toArray();
        }

        try {
            $courses = DB::table('courses')
                ->leftJoin('enrollments', 'courses.id', '=', 'enrollments.course_id')
                ->where('courses.designer_id', $designer->id)
                ->select(
                    'courses.title',
                    'courses.price',
                    DB::raw('COUNT(enrollments.id) as enrollments'),
                    DB::raw('SUM(enrollments.amount_paid) as revenue')
                )
                ->groupBy('courses.id', 'courses.title', 'courses.price')
                ->orderBy('enrollments', 'desc')
                ->take(5)
                ->get();

            if ($courses->isEmpty()) {
                return [];
            }

            return $courses->map(function($course) {
                return [
                    'title' => $course->title,
                    'enrollments' => (int)$course->enrollments,
                    'revenue' => (float)($course->revenue ?? 0)
                ];
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getRealCategoryDistribution($designer)
    {
        try {
            $categories = DB::table('products')
                ->where('products.designer_id', $designer->id)
                ->select(
                    DB::raw('COALESCE(products.category, "Uncategorized") as category'),
                    DB::raw('COUNT(DISTINCT products.id) as product_count')
                )
                ->groupBy('products.category')
                ->get();

            if ($categories->isEmpty()) {
                return [];
            }

            return $categories->map(function($category) {
                return [
                    'name' => ucwords(str_replace('-', ' ', $category->category)),
                    'value' => (int)$category->product_count,
                    'revenue' => 0.0 // Will be 0 if no order data
                ];
            })->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    private function getRecentActivities($designer)
    {
        $activities = [];
        
        try {
            // Get recent products
            $recentProducts = $designer->products()->latest()->take(3)->get();
            foreach ($recentProducts as $product) {
                $activities[] = [
                    'icon' => 'plus',
                    'message' => "Added new product: {$product->name}",
                    'time' => $product->created_at->diffForHumans(),
                    'created_at' => $product->created_at
                ];
            }
            
            // Get recent courses
            $recentCourses = $designer->courses()->latest()->take(2)->get();
            foreach ($recentCourses as $course) {
                $activities[] = [
                    'icon' => 'graduation-cap',
                    'message' => "Created new course: {$course->title}",
                    'time' => $course->created_at->diffForHumans(),
                    'created_at' => $course->created_at
                ];
            }

            // Get recent orders (if tables exist)
            if (Schema::hasTable('orders') && Schema::hasTable('order_items')) {
                $recentOrders = DB::table('orders')
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->where('products.designer_id', $designer->id)
                    ->where('orders.status', 'completed')
                    ->select('orders.*')
                    ->distinct()
                    ->orderBy('orders.created_at', 'desc')
                    ->take(2)
                    ->get();

                foreach ($recentOrders as $order) {
                    $activities[] = [
                        'icon' => 'shopping-bag',
                        'message' => "New order received: #{$order->id}",
                        'time' => Carbon::parse($order->created_at)->diffForHumans(),
                        'created_at' => Carbon::parse($order->created_at)
                    ];
                }
            }
        } catch (\Exception $e) {
            // If there's an error, just return empty activities
        }
        
        // Sort by time and limit
        return collect($activities)
            ->sortByDesc('created_at')
            ->take(5)
            ->map(function($activity) {
                unset($activity['created_at']); // Remove sorting field
                return $activity;
            })
            ->values()
            ->toArray();
    }
}
