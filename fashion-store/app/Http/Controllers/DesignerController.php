<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Course;
use App\Models\FashionEvent;
use Illuminate\Http\Request;

class DesignerController extends Controller
{
    /**
     * Display a listing of the designers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all designers with optional filters
        $designers = User::where('is_designer', true)
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->paginate(12);
        
        return view('designers.index', compact('designers'));
    }

    /**
     * Display the specified designer.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        // Check if the user is a designer
        if (!$user->is_designer) {
            abort(404, 'Designer not found');
        }
        
        // Get designer's products
        $products = Product::where('designer_id', $user->id)
            ->with('discount')
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        
        // Get designer's courses
        $courses = Course::where('designer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        // Get designer's upcoming fashion events
        $events = FashionEvent::where('designer_id', $user->id)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(2)
            ->get();
        
        // Get designer's media/gallery if applicable
        $mediaItems = [];
        if (class_exists('\App\Models\DesignerMedia')) {
            $mediaItems = \App\Models\DesignerMedia::where('designer_id', $user->id)
                ->orderBy('uploaded_at', 'desc')
                ->take(8)
                ->get();
        }
        
        return view('designers.show', compact(
            'user', 
            'products', 
            'courses', 
            'events', 
            'mediaItems'
        ));
    }
}