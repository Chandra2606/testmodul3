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

    public function show($id)
    {
        $article = Article::with(['author', 'categories', 'tags'])->findOrFail($id);

        // Get related articles
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->whereHas('categories', function ($query) use ($article) {
                $query->whereIn('categories.id', $article->categories->pluck('id'));
            })
            ->with(['author', 'categories'])
            ->latest()
            ->take(2)
            ->get();

        // Ubah dari return response()->json() menjadi return view()
        return view('show', compact('article', 'relatedArticles'));
    }
}
