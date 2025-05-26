<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $products = [];
        $subtotal = 0;
        $discount = 0;
        $total = 0;
        
        foreach ($cart as $key => $details) {
            $id = explode('-', $key)[0]; // استخراج product_id من key
            $product = Product::with(['designer', 'category'])->find($id);
            
            if ($product) {
                // حساب السعر الأصلي والسعر بعد الخصم
                $originalPrice = $product->price;
                $discountedPrice = $product->hasDiscount() ? $product->discounted_price : $product->price;
                
                // حساب المجموع للمنتج الواحد
                $itemSubtotal = $originalPrice * $details['quantity'];
                $itemTotal = $discountedPrice * $details['quantity'];
                
                // إضافة إلى المجموع الكلي والخصم
                $subtotal += $itemSubtotal;
                $total += $itemTotal;
                
                // إضافة المنتج إلى مصفوفة المنتجات
                $products[] = [
                    'product' => $product,
                    'size' => $details['size'],
                    'quantity' => $details['quantity'],
                    'price' => $discountedPrice,
                    'total' => $itemTotal
                ];
            }
        }
        
        // حساب إجمالي الخصم
        $discount = $subtotal - $total;
        
        return view('cart.index', [
            'products' => $products,
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total
        ]);
    }
    
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);

        $product_id = $request->product_id;
        $size = $request->size;
        $quantity = $request->quantity;
        
        // Create a unique key for the product based on ID and size
        $cartItemKey = $product_id . '-' . $size;
        
        // Get the current cart
        $cart = session()->get('cart', []);
        
        // Check if this product+size combination is already in the cart
        if (isset($cart[$cartItemKey])) {
            // Update quantity
            $cart[$cartItemKey]['quantity'] += $quantity;
        } else {
            // Add new item
            $cart[$cartItemKey] = [
                'size' => $size,
                'quantity' => $quantity
            ];
        }
        
        // Update cart in session
        session()->put('cart', $cart);
        
        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart successfully!',
                'cartCount' => count($cart)
            ]);
        }
        
        // For non-AJAX requests, redirect with success message
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $key = $request->key;
        $quantity = $request->quantity;
        
        // Get the current cart
        $cart = session()->get('cart', []);
        
        // Check if this cart item exists
        if (isset($cart[$key])) {
            // Update quantity
            $cart[$key]['quantity'] = $quantity;
            
            // Update cart in session
            session()->put('cart', $cart);
            
            // Calculate updated totals
            $product_id = explode('-', $key)[0];
            $product = Product::find($product_id);
            $price = $product->hasDiscount() ? $product->discounted_price : $product->price;
            $itemTotal = $price * $quantity;
            
            return response()->json([
                'status' => 'success',
                'message' => 'Cart updated successfully!',
                'itemTotal' => $itemTotal,
                'subtotal' => $this->calculateCartSubtotal($cart),
                'discount' => $this->calculateCartDiscount($cart),
                'cartTotal' => $this->calculateCartTotal($cart),
                'cartCount' => count($cart)
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Cart item not found!'
        ], 404);
    }
    
    public function remove(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
        ]);
        
        $key = $request->key;
        
        // Get the current cart
        $cart = session()->get('cart', []);
        
        // Check if this cart item exists
        if (isset($cart[$key])) {
            // Remove the item
            unset($cart[$key]);
            
            // Update cart in session
            session()->put('cart', $cart);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Item removed from cart successfully!',
                'subtotal' => $this->calculateCartSubtotal($cart),
                'discount' => $this->calculateCartDiscount($cart),
                'cartTotal' => $this->calculateCartTotal($cart),
                'cartCount' => count($cart)
            ]);
        }
        
        return response()->json([
            'status' => 'error',
            'message' => 'Cart item not found!'
        ], 404);
    }
    
    public function clear()
    {
        // Clear cart session
        session()->forget('cart');
        
        return response()->json([
            'status' => 'success',
            'message' => 'Cart cleared successfully!'
        ]);
    }
    
    /**
     * معالجة عملية الـ checkout وحفظ الطلب في قاعدة البيانات
     */
    public function checkout(Request $request)
    {
        try {
            // التحقق من صحة البيانات المرسلة
            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:1000'
            ]);
            
            // الحصول على السلة من الجلسة
            $cart = session()->get('cart', []);
            
            // التحقق من أن السلة ليست فارغة
            if (empty($cart)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your cart is empty!'
                ], 400);
            }
            
            // بداية المعاملة (Transaction) لضمان سلامة البيانات
            DB::beginTransaction();
            
            // حساب المجموع الكلي
            $totalAmount = $this->calculateCartTotal($cart);
            
            // إنشاء طلب جديد
            $order = Order::create([
                'user_id' => auth()->id() ?? null, // إذا كان المستخدم مسجل دخول
                'status' => 'pending',
                'total_price' => $totalAmount,
                'customer_name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
                'customer_email' => $validatedData['email'],
                'customer_phone' => $validatedData['phone'],
                'shipping_address' => $validatedData['address']
            ]);
            
            // إضافة عناصر الطلب
            foreach ($cart as $key => $details) {
                $product_id = explode('-', $key)[0];
                $product = Product::find($product_id);
                
                if ($product) {
                    $price = $product->hasDiscount() ? $product->discounted_price : $product->price;
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product_id,
                        'size' => $details['size'],
                        'quantity' => $details['quantity'],
                        'price' => $price
                    ]);
                }
            }
            
            // تأكيد المعاملة
            DB::commit();
            
            // مسح السلة بعد إتمام الطلب بنجاح
            session()->forget('cart');
            
            return response()->json([
                'status' => 'success',
                'message' => 'تم إكمال طلبك بنجاح! سيتم التواصل معك قريباً لتأكيد الطلب.',
                'order_id' => $order->id
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'يرجى التحقق من البيانات المدخلة.',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ أثناء معالجة طلبك. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }
    
    private function calculateCartSubtotal($cart)
    {
        $subtotal = 0;
        
        foreach ($cart as $key => $details) {
            $id = explode('-', $key)[0];
            $product = Product::find($id);
            
            if ($product) {
                $subtotal += $product->price * $details['quantity'];
            }
        }
        
        return $subtotal;
    }
    
    private function calculateCartDiscount($cart)
    {
        $subtotal = $this->calculateCartSubtotal($cart);
        $total = $this->calculateCartTotal($cart);
        
        return $subtotal - $total;
    }
    
    private function calculateCartTotal($cart)
    {
        $total = 0;
        
        foreach ($cart as $key => $details) {
            $id = explode('-', $key)[0];
            $product = Product::find($id);
            
            if ($product) {
                $price = $product->hasDiscount() ? $product->discounted_price : $product->price;
                $total += $price * $details['quantity'];
            }
        }
        
        return $total;
    }
}