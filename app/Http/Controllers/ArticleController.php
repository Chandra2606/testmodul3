<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('article.index');
    }
    
    public function show($id)
    {
        $articles = Article::with(['author', 'categories', 'tags'])->get();

        return response()->json(['data' => $articles]);

    }
    
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('article.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
     {
        if($request->ajax()) {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category' => 'required',
                'tags' => 'required|array|min:1',
                'author_id' => 'required'
             
            ]);
            $article = Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'author_id' => $request->author_id
            ]);

            $article->categories()->attach($request->category);

            if($request->tags) {
                $article->tags()->attach($request->tags);
            }

            return response()->json([
                'success' => true,
                'message' => 'Article data has been successfully saved!',
                'type' => 'success'
            ]);
        }
        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function edit($id)
    {
        $article = Article::with(['author', 'categories', 'tags'])->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('article.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()) {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category' => 'required',
                'tags' => 'required|array|min:1',
                'author_id' => 'required'
            ]);

            $article = Article::findOrFail($id);
            $article->update([
                'title' => $request->title,
                'content' => $request->content,
                'author_id' => $request->author_id
            ]);

            $article->categories()->sync($request->category);
            $article->tags()->sync($request->tags);

            return response()->json([
                'success' => true,
                'message' => 'Article data has been successfully updated!',
                'type' => 'success'
            ]);

        }
        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function destroy($id, Request $request)
    {
       if($request->ajax()) {
        $article = Article::findOrFail($id);
        $article->categories()->detach();
        $article->tags()->detach();
        $article->delete();
        return response()->json([
            'success' => true,
            'message' => 'Article data has been successfully deleted!',
            'type' => 'success'
        ]);
       }
       return response()->json(['message' => 'Invalid request'], 400);
    }

    public function detail($id)
    {
        $article = Article::with(['author', 'categories', 'tags'])->findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('article.detail', compact('article', 'categories', 'tags'));
    }
}
