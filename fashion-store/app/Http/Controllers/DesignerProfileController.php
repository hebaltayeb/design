<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Course;
use App\Models\FashionEvent;
use App\Models\CustomizeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignerProfileController extends Controller
{
    /**
     * Display the designer's profile.
     *
     * @param User $designer
     * @return \Illuminate\View\View
     */
    public function show(User $designer)
    {
        // Check if the user is actually a designer
        if (!$designer->is_designer) {
            abort(404, 'Designer not found');
        }
        
        // Get the designer's ready-to-wear products
        $readyToWearProducts = Product::where('designer_id', $designer->id)
            ->where('is_customizable', false)
            ->with(['discount', 'sizes'])
            ->orderBy('created_at', 'desc')
            ->paginate(6, ['*'], 'ready_page');
        
        // Get the designer's customizable products
        $customizableProducts = Product::where('designer_id', $designer->id)
            ->where('is_customizable', true)
            ->with(['discount', 'sizes'])
            ->orderBy('created_at', 'desc')
            ->paginate(6, ['*'], 'custom_page');
        
        // Get the designer's courses
        $courses = Course::where('designer_id', $designer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(3, ['*'], 'courses_page');
        
        // Get the designer's upcoming fashion events
        $events = FashionEvent::where('designer_id', $designer->id)
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->paginate(3, ['*'], 'events_page');
        
        // Get designer's media/gallery if available
        $mediaItems = [];
        if (class_exists('\App\Models\DesignerMedia')) {
            $mediaItems = \App\Models\DesignerMedia::where('designer_id', $designer->id)
                ->orderBy('uploaded_at', 'desc')
                ->take(8)
                ->get();
        }
        
        return view('designers.profile', compact(
            'designer',
            'readyToWearProducts',
            'customizableProducts',
            'courses',
            'events',
            'mediaItems'
        ));
    }
    
    /**
     * Submit a customization request.
     *
     * @param Request $request
     * @param User $designer
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitCustomization(Request $request, User $designer, Product $product)
    {
        // Validate the request
        $validated = $request->validate([
            'size' => 'required|string',
            'color' => 'nullable|string',
            'fabric_type' => 'nullable|string',
            'sleeve_type' => 'nullable|string',
            'custom_note' => 'required|string|min:10',
        ]);
        
        // Create the customization request
        $customizeRequest = new CustomizeRequest();
        $customizeRequest->user_id = Auth::id();
        $customizeRequest->product_id = $product->id;
        $customizeRequest->size = $validated['size'];
        $customizeRequest->color = $validated['color'] ?? null;
        $customizeRequest->fabric_type = $validated['fabric_type'] ?? null;
        $customizeRequest->sleeve_type = $validated['sleeve_type'] ?? null;
        $customizeRequest->custom_note = $validated['custom_note'];
        $customizeRequest->status = 'pending';
        $customizeRequest->save();
        
        return redirect()->back()->with('success', 'Your customization request has been sent to the designer. They will contact you soon!');
    }
    
    /**
     * Enroll in a course.
     *
     * @param Request $request
     * @param User $designer
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enrollCourse(Request $request, User $designer, Course $course)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string',
        ]);
        
        // Create the enrollment
        $enrollment = new \App\Models\Enrollment();
        $enrollment->user_id = Auth::id();
        $enrollment->course_id = $course->id;
        $enrollment->name = $validated['name'];
        $enrollment->email = $validated['email'];
        $enrollment->phone = $validated['phone'];
        $enrollment->notes = $validated['notes'] ?? null;
        $enrollment->payment_status = 'pending';
        $enrollment->save();
        
        return redirect()->back()->with('success', 'Your course enrollment has been received. The designer will contact you with payment details!');
    }
    
    /**
     * RSVP for a fashion event.
     *
     * @param Request $request
     * @param User $designer
     * @param FashionEvent $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rsvpEvent(Request $request, User $designer, FashionEvent $event)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'nullable|integer|min:0|max:5',
        ]);
        
        // Create the RSVP (assuming you have an EventRSVP model)
        // If you don't have this model, you would need to create it
        if (class_exists('\App\Models\EventRSVP')) {
            $rsvp = new \App\Models\EventRSVP();
            $rsvp->user_id = Auth::id();
            $rsvp->event_id = $event->id;
            $rsvp->name = $validated['name'];
            $rsvp->email = $validated['email'];
            $rsvp->phone = $validated['phone'];
            $rsvp->guest_count = $validated['guests'] ?? 0;
            $rsvp->save();
        }
        
        return redirect()->back()->with('success', 'Your RSVP has been received. We look forward to seeing you at the event!');
    }
}