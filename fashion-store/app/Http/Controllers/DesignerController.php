<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Course;
use App\Models\FashionEvent;
use App\Models\CustomizeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $designer = $user;
        
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
            'designer',
            'products', 
            'courses', 
            'events', 
            'mediaItems'
        ));
    }

    /**
     * Submit a customization request for a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function customizeRequest(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size' => 'required|string',
            'color' => 'required|string',
            'fabric_type' => 'required|string',
            'sleeve_type' => 'required|string',
            'custom_note' => 'nullable|string',
        ]);

        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('warning', 'Please login to submit a customization request.');
        }

        // Create new customization request
        CustomizeRequest::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'size' => $request->size,
            'color' => $request->color,
            'fabric_type' => $request->fabric_type,
            'sleeve_type' => $request->sleeve_type,
            'custom_note' => $request->custom_note,
            'status' => 'pending',
        ]);

        return redirect()->back()
            ->with('success', 'Your customization request has been submitted. The designer will contact you soon.');
    }

    /**
     * Contact the designer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contact(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $designer = User::findOrFail($id);

        // Here you would normally send an email or notification to the designer
        // For now, we'll just redirect with a success message

        return redirect()->back()
            ->with('success', 'Your message has been sent to the designer.');
    }
}