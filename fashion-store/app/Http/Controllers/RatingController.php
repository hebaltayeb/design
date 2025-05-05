<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10',
        ]);

        // Check if user already rated this product
        $existingRating = Rating::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingRating) {
            // Update existing rating
            $existingRating->update([
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
            
            $message = 'Your review has been updated!';
        } else {
            // Create new rating
            Rating::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
            
            $message = 'Thank you for your review!';
        }

        return redirect()->back()->with('success', $message);
    }
}


