<?php
namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FashionEvent;

class EventController extends Controller
{
    public function index()
    {
        $events = FashionEvent::where('designer_id', Auth::id())->get();
        return view('designer.events.index', compact('events'));
    }

    public function create()
    {
        return view('designer.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['designer_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        FashionEvent::create($data);

        return redirect()->route('designer.dashboard')->with('success', 'تم إضافة الفعالية بنجاح');
    }

    public function edit(FashionEvent $event)
    {
        $this->authorizeEvent($event);
        return view('designer.events.edit', compact('event'));
    }

    public function update(Request $request, FashionEvent $event)
    {
        $this->authorizeEvent($event);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('designer.dashboard')->with('success', 'تم تحديث الفعالية بنجاح');
    }

    public function destroy(FashionEvent $event)
    {
        $this->authorizeEvent($event);
        $event->delete();
        return redirect()->route('designer.dashboard')->with('success', 'تم حذف الفعالية بنجاح');
    }

    private function authorizeEvent(FashionEvent $event)
    {
        if ($event->designer_id !== Auth::id()) {
            abort(403);
        }
    }
}