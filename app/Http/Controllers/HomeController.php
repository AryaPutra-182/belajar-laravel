<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.landing', [
            'products' => Product::latest()->take(8)->get(),
            'articles' => Article::latest()->take(3)->get(),
        ]);
    }
}
