<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Show all orders
    public function index(Request $request)
{
    $orders = Order::with('products');

    if ($request->filled('date')) {
        $orders->whereDate('created_at', $request->date);
    }
     // ✅ Filter by status
    if ($request->filled('status') && in_array($request->status, ['pending', 'validated'])) {
        $orders->where('status', $request->status);
    }


    $orders = $orders->get();

    return view('dashboard.orders.index', compact('orders'));
}

    // Pending orders
    public function pending()
    {
        $orders = Order::with('products')->where('status','pending')->get();
        return view('dashboard.orders.pending', compact('orders'));
    }

    // Validated orders
    public function validated()
    {
        $orders = Order::with('products')->where('status','validated')->get();
        return view('dashboard.orders.validated', compact('orders'));
    }

    // Validate an order
    public function validateOrder(Order $order)
    {
        $order->status = 'validated';
        $order->save();
        return redirect()->back()->with('success','Order validated!');
    }

    // Delete order
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success','Order deleted!');
    }
}
