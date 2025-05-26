<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('designer_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get(); // Changed from paginate to get for now

        return response()->json([
            'data' => $products,
            'success' => true
        ]);
    }

    public function create()
    {
        return view('designer.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:100',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['designer_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('designer.dashboard')
            ->with('success', 'Product added successfully!');
    }

    public function show(Product $product)
    {
        $this->authorizeProduct($product);

        return response()->json($product);
    }

    public function edit(Product $product)
    {
        $this->authorizeProduct($product);

        return view('designer.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:100',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('designer.dashboard')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('designer.dashboard')
            ->with('success', 'Product deleted successfully!');
    }

    private function authorizeProduct(Product $product)
    {
        if ($product->designer_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
