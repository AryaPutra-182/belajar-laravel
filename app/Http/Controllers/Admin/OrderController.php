<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
   public function index()
   {
     $user = auth()->user();

    if ($user->role === 'masteradmin') {
        $orders = Order::latest()->get();
    } else {
        $orders = Order::whereHas('items.product', function ($q) use ($user) {
            $q->where('admin_id', $user->id);
        })->latest()->get();
    }

    return view('admin.orders.index', compact('orders'));
   }        

   public function update(Order $order){
    $order->update([
        'status' => request('status')
    ]);
    return back()->with('success','Status pesanan berhasil diubah');
   }
}
