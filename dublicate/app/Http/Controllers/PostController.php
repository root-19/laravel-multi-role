<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    // Show all posts
    public function index() 
    {
        $posts = Post::latest()->get();
        return view('welcome.post', compact('posts')); // ✅ Fix variable name
    }
    
    // Show the form to create a new post
    public function create()
    {
        return view('welcome.create');
    }

    // Store the post in DB
    public function store(Request $request)
    {
        $request->validate([
            'posting' => 'required|string|max:1000',
        ]);

        Post::create([
            'user_id' => Auth::id(), // ✅ Fix 'user-id' to 'user_id'
            'posting' => $request->posting,
        ]);

        return redirect()->route('welcome.index')->with('success', 'Posting created successfully!');
    }
}
