<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
USE App\Models\OrderItem;

class ProductPageController extends Controller
{
    public function index()
    {
           $products = Product::latest()->take(8)->get(); // produk terbaru
           return view('user.landing', compact('products'));
    }

    public function show(Product $product)
    {
       
    $hasBought = false;

    if (auth()->check()) {
        $hasBought = OrderItem::where('product_id', $product->id)
            ->whereHas('order', function ($q) {
                $q->where('user_id', auth()->id())
                  ->whereIn('status', ['Selesai','Done','done','selesai']);
            })
            ->exists();
    }

    return view('user.products.show', compact('product','hasBought'));
    }
}
