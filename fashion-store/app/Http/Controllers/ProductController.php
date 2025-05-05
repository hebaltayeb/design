<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // الحصول على جميع التصنيفات لعرضها في الفلتر
        $categories = Category::all();
        
        // بناء الاستعلام حسب الفلاتر المطبقة
        $query = Product::query();
        
        // فلتر حسب التصنيف
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }
        
        // فلتر حسب السعر
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price', '<=', $request->max_price);
        }
        
        // فلتر حسب اللون
        if ($request->has('color') && $request->color != '') {
            $query->where('color', $request->color);
        }
        
        // الترتيب
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
        
        // الحصول على الألوان المتوفرة للفلتر
        $colors = DB::table('products')->select('color')->distinct()->pluck('color');
        
        // تقسيم النتائج إلى صفحات
        $products = $query->with('designer')->paginate(12);
        
        return view('products.index', compact('products', 'categories', 'colors'));
    }
}