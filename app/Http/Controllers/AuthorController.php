<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return view('author.index');
    }

    public function show()
    {
        $author = Author::all();
        return response()->json(['data' => $author]);
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:authors,email',
        ]);

        Author::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Author created successfully',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        Author::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'Author deleted successfully', 'type' => 'success']);
    }

    public function edit($id)
    {
        $author = Author::find($id);
        return response()->json(['data' => $author]);
    }

    public function update(Request $request, $id)
    {
        if($request->ajax()) {
        $validated = $request->validate([
            'nameEdit' => 'required|string|max:255',
            'emailEdit' => 'required|email|unique:authors,email,' . $id,
        ]);

        Author::find($id)->update([
            'name' => $request->nameEdit,
            'email' => $request->emailEdit
        ]);
            return response()->json(['success' => true, 'message' => 'Author updated successfully', 'type' => 'success']);
        }
    }
}
