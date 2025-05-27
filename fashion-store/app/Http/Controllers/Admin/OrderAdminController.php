<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User; // Add this line
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    /**
     * Display a listing of orders
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderItems.product']);
        
        // Add filtering
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }
        
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->get('date_from'));
        }
        
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->get('date_to'));
        }
        
        // Use paginate() instead of get()
        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }
    
    /**
     * Show order details
     */
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show form to edit order
     */
    public function edit(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        $users = User::all(); // This line needs the User import
        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        
        return view('admin.orders.edit', compact('order', 'users', 'statuses'));
    }

    /**
     * Update order status
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully');
    }

    /**
     * Delete an order
     */
    public function destroy(Order $order)
    {
        // Delete all order items first
        $order->orderItems()->delete();
        
        // Then delete the order
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully');
    }
}