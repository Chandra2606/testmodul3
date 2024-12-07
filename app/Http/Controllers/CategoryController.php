<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index');
    }

    public function show()
    {
        $category = Category::all();
        return response()->json(['data' => $category]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            Category::create($request->all());
            return response()->json(['success' => true, 'message' => 'Category created successfully', 'type' => 'success']);
        }
        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'Category deleted successfully', 'type' => 'success']);
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json(['data' => $category]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()) {
            $request->validate([
                'nameEdit' => 'required|string|max:255',
            ]);
            Category::find($id)->update([
                'name' => $request->nameEdit
            ]);
            return response()->json(['success' => true, 'message' => 'Category updated successfully', 'type' => 'success']);
        }
        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }
}
