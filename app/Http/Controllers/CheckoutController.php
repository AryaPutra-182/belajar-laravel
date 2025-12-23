<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
        ]);

        Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'qty' => $request->qty,
            'price' => $product->price,
            'total' => $product->price * $request->qty,
        ]);

        return redirect()->route('orders.mine')
            ->with('success','Pesanan berhasil dibuat');
    }

    public function myOrders()
    {
        $orders = Order::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.orders.index', compact('orders'));
    }
}
