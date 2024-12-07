<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index');
    }

    public function show()
    {
        $tags = Tag::all();
        return response()->json(['data' => $tags]);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            Tag::create($request->all());
            return response()->json(['success' => true, 'message' => 'Tag created successfully', 'type' => 'success']);
        }
        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }

    public function destroy($id)
    {
        Tag::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'Tag deleted successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $tag = Tag::find($id);
        return response()->json(['data' => $tag]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()) {
            $request->validate([
                'nameEdit' => 'required|string|max:255',
            ]);
            Tag::find($id)->update([
                'name' => $request->nameEdit
            ]);
            return response()->json(['success' => true, 'message' => 'Tag updated successfully', 'type' => 'success']);
        }
        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }
}
