<?php
// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($request->product_id);
        $size = Size::where('product_id', $product->id)
            ->where('size', $request->size)
            ->where('stock_quantity', '>=', $request->quantity)
            ->firstOrFail();

        // Add to cart logic here (using session or database)
        // This is a simplified example
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        
        $cartItem = [
            'id' => uniqid(),
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->hasDiscount() ? $product->discounted_price : $product->price,
            'size' => $request->size,
            'quantity' => $request->quantity,
            'image' => $product->image,
        ];
        
        $cart = session()->get('cart');
        $cart[] = $cartItem;
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}

