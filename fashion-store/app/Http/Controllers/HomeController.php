<?php namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     * 
     * @return \Illuminate\View\View
     */
    public function landingPage()
    {
        // Get featured designers (users with is_designer = true)
        $designers = User::where('is_designer', true)
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
        
        // Get featured products
        $featuredProducts = Product::with('designer')
                                ->where('is_featured', true)
                                ->orWhere(function($query) {
                                    $query->orderBy('sales_count', 'desc');
                                })
                                ->take(4)
                                ->get();
        
        // Get featured courses
        $featuredCourses = Course::with('designer')
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get();
        
        // Get product categories
        $categories = Category::all();

        // Get top products based on sales count
        $topProducts = Product::orderBy('sales_count', 'desc')->take(4)->get();
        
        // Pass all data to the view
        return view('landing', compact(
            'designers', 
            'featuredProducts', 
            'featuredCourses', 
            'categories', 
            'topProducts'  // إضافة المتغير
        ));
    }
}
