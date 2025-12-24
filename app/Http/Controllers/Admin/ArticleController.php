<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('admin.articles.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'thumbnail' => 'image|nullable'
        ]);

        $data = $request->only('title','content');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('articles','public');
        }

        $article = Article::create($data);

        if ($request->products) {
            $article->products()->sync($request->products);
        }

        return redirect()->route('admin.articles.index')
            ->with('success','Artikel berhasil dibuat');
    }

    public function show(Article $article)
    {
        $article->load('products');
        return view('admin.articles.show', compact('article'));
    }

    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();
        return back();
    }
    public function edit(Article $article)
{
    $products = Product::orderBy('name')->get();
    $article->load('products');

    return view('admin.articles.edit', compact('article','products'));
}

public function update(Request $request, Article $article)
{
    $request->validate([
        'title'   => 'required',
        'content' => 'required',
        'thumbnail' => 'image|nullable'
    ]);

    $data = $request->only('title','content');

    if ($request->hasFile('thumbnail')) {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $data['thumbnail'] = $request->file('thumbnail')
            ->store('articles','public');
    }

    $article->update($data);

    // update produk terkait
    if ($request->products) {
        $article->products()->sync($request->products);
    } else {
        $article->products()->sync([]);
    }

    return redirect()->route('admin.articles.index')
        ->with('success','Artikel berhasil diperbarui');
}

}
