<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function store(Product $product)
    {
        $qty = request('qty', 1);
        $total = $product->price * $qty;

        $order = Order::create([
            'user_id' => auth()->id(),
            'total'   => $total,
            'status'  => 'pending',
        ]);

        OrderItem::create([
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'quantity'   => $qty,
            'price'      => $product->price,
        ]);

        return redirect()->route('orders.mine')
            ->with('success', 'Pesanan berhasil dibuat');
    }

    // 🔥 INI YANG KURANG
    public function myOrders()
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.orders.index', compact('orders'));
    }
}
