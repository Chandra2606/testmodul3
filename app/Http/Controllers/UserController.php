<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function show()
    {
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'password_confirmation' => 'required|string|min:8|same:password',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'User data has been successfully saved!',
                'type' => 'success'
            ]);
        }
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if($request->ajax()) {
            $user->update($request->all());
            return response()->json($user);
        }
    }

    public function destroy(Request $request, User $user)
    {
        if($request->ajax()) {
        $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User data has been successfully deleted!',
                'type' => 'success'
            ]);
        }
    }

    
}