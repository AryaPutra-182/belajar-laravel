<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticlePageController extends Controller
{
    public function index(){
        $articles = Article::latest()->get();
        return view('user.articles.index', compact('articles'));
    }
    public function show(Article $article){
        return view('user.articles.show', compact('article'));
    }
}
