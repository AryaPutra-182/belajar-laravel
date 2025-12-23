<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductPageController extends Controller
{
    public function index()
    {
           $products = Product::latest()->take(8)->get(); // produk terbaru
           return view('user.landing', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('category', 'reviews.user');
        return view('user.products.show', compact('product'));
    }
}
