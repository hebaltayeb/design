<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the user's favorites.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all favorites for the authenticated user with related product info
        $favorites = Favorite::where('user_id', Auth::id())
            ->with(['product.designer', 'product.discount', 'product.ratings'])
            ->latest('created_at')
            ->paginate(10);
        
        // Count total favorites for counter display
        $favoritesCount = Favorite::where('user_id', Auth::id())->count();
        
        return view('favorites.index', compact('favorites', 'favoritesCount'));
    }

    /**
     * Toggle a product as favorite/unfavorite.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle(Request $request)
    {
        Log::info('Toggle favorite called', $request->all());
        
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        $productId = $request->product_id;
        $userId = Auth::id();
        
        // Check if the product is already favorited
        $favorite = Favorite::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->first();
        
        if ($favorite) {
            // Remove from favorites
            $favorite->delete();
            
            // Decrement the product's favorites_count if available
            $product = Product::find($productId);
            if ($product && $product->favorites_count > 0) {
                $product->decrement('favorites_count');
            }
            
            $message = 'Product removed from favorites';
            $status = 'success';
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'created_at' => now()
            ]);
            
            // Increment the product's favorites_count if available
            $product = Product::find($productId);
            if ($product) {
                $product->increment('favorites_count');
            }
            
            $message = 'Product added to favorites';
            $status = 'success';
        }
        
        // If the request is AJAX, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'count' => Favorite::where('user_id', $userId)->count()
            ]);
        }
        
        // For regular requests, redirect back with a flash message
        return back()->with($status, $message);
    }
    
    /**
     * Remove a product from favorites.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request)
    {
        Log::info('Remove favorite called', $request->all());
        
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        $favorite = Favorite::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();
        
        if ($favorite) {
            $favorite->delete();
            
            // Decrement the product's favorites_count if available
            $product = Product::find($request->product_id);
            if ($product && $product->favorites_count > 0) {
                $product->decrement('favorites_count');
            }
            
            // If the request is AJAX, return JSON response
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product removed from favorites',
                    'count' => Favorite::where('user_id', Auth::id())->count()
                ]);
            }
            
            return back()->with('success', 'Product removed from favorites');
        }
        
        // If the request is AJAX, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found in favorites'
            ]);
        }
        
        return back()->with('error', 'Product not found in favorites');
    }
    
    /**
     * Add all favorite products to cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addAllToCart()
    {
        $favorites = Favorite::where('user_id', Auth::id())->with('product')->get();
        
        $addedCount = 0;
        
        foreach ($favorites as $favorite) {
            // Add product to cart with default size (M) and quantity (1)
            try {
                app(CartController::class)->add(new Request([
                    'product_id' => $favorite->product_id,
                    'size' => 'M', // Default size
                    'quantity' => 1 // Default quantity
                ]));
                
                $addedCount++;
            } catch (\Exception $e) {
                // Log error
                Log::error('Failed to add product to cart', [
                    'product_id' => $favorite->product_id,
                    'error' => $e->getMessage()
                ]);
                continue;
            }
        }
        
        if ($addedCount > 0) {
            return redirect()->route('cart.index')
                            ->with('success', "{$addedCount} products added to cart");
        }
        
        return back()->with('error', 'Failed to add products to cart');
    }
}