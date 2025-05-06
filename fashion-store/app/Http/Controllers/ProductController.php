<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of products with filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get all categories for the filter
        $categories = Category::all();
        
        // Get all designers for the designer filter
        $designers = User::where('is_designer', true)->get();
        
        // Build the query based on applied filters
        $query = Product::query()->with('designer');
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Filter by color
        if ($request->has('color') && $request->color != '') {
            $query->where('color', $request->color);
        }
        
        // Filter by designer
        if ($request->has('designer') && $request->designer != '') {
            $query->where('designer_id', $request->designer);
        }
        
        // Sort products
        $sort = $request->input('sort', 'newest');
        
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popularity':
                $query->orderBy('sales_count', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        // Get available colors for the filter
        $colors = DB::table('products')->select('color')->distinct()->pluck('color');
        
        // Paginate the results
        $products = $query->paginate(12);
        
        return view('products.index', compact('products', 'categories', 'colors', 'designers'));
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        // Load related data
        $product->load(['designer', 'sizes', 'ratings.user', 'discount']);
        
        // Get related products from same designer or category
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->where(function($query) use ($product) {
                $query->where('designer_id', $product->designer_id)
                      ->orWhere('category_id', $product->category_id);
            })
            ->with('designer')
            ->limit(4)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
    }
}