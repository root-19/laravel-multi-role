<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index() 
    {
        $posts = Post::latest()->get();
        return view('welcome.post', compact('posts'));
    }
    
    public function create()
    {
        return view('welcome.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'posting' => 'required|string|max:1000',
        ]);

        Post::create([
            'user_name' => Auth::user()->name,
            'user_id'   => Auth::id(),
            'posting'   => $request->posting,
        ]);

        return redirect()->route('welcome.post')->with('success', 'Posting created successfully!');
    }
}
