<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the user's favorites.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all favorites for the authenticated user
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('product.designer')
            ->paginate(12);
        
        return view('favorites.index', compact('favorites'));
    }

    /**
     * Toggle a product's favorite status for the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        
        // Check if the product is already favorited
        $favorite = Favorite::where('user_id', Auth::id())
                            ->where('product_id', $request->product_id)
                            ->first();
        
        if ($favorite) {
            // Remove from favorites
            $favorite->delete();
            
            // Decrement the product's favorites_count
            $product = Product::find($request->product_id);
            if ($product && $product->favorites_count > 0) {
                $product->decrement('favorites_count');
            }
            
            $message = __('Product removed from favorites');
        } else {
            // Add to favorites
            Favorite::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'created_at' => now(),
            ]);
            
            // Increment the product's favorites_count
            Product::find($request->product_id)
                ->increment('favorites_count');
            
            $message = __('Product added to favorites');
        }
        
        // Redirect back with success message
        return back()->with('success', $message);
    }
}