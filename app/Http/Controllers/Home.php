<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index()
    {
        $articles = Article::with(['author', 'categories', 'tags'])
        ->latest()
            ->take(10)
            ->get();

        $categories = Category::all();
        $tags = Tag::all();

        return view('home', compact('articles', 'categories', 'tags'));
    }
}
