<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $total = 0;

        // تعديل الحلقات لتقسيم الـ key واسترجاع الـ product_id
        foreach ($cart as $key => $details) {
            $id = explode('-', $key)[0]; // استخراج الـ product_id من الـ key
            $product = Product::find($id);
            
            if ($product) {
                $price = $product->hasDiscount() ? $product->discounted_price : $product->price;
                $itemTotal = $price * $details['quantity'];
                $total += $itemTotal;
                
                $products[] = [
                    'product' => $product,
                    'size' => $details['size'],
                    'quantity' => $details['quantity'],
                    'price' => $price,
                    'total' => $itemTotal
                ];
            }
        }
        
        return view('cart.index', compact('products', 'total'));
    }
    
    // باقي الوظائف الأخرى كما هي
}
