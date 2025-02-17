<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
// use App\Models\User;

class PostController extends Controller
{
  
    public function index()
{
    $posts = Post::where('user_id', auth()->id())->latest()->get();

    return view('welcome.post', compact('posts'));
}
    
    // Show posts from all users.
    public function dashboard()
    {
        $posts = Post::withCount('reactions')->with('comments')->latest()->get();
        $users = \App\Models\User::orderBy('name')->get();

        //get 10 post with mostreaction 
        $hotThreads = Post::withCount('reactions')
        ->orderByDesc('reactions_count')
        ->take(10)
        ->get();
    
        return view('welcome.welcome', compact('posts', 'users', 'hotThreads')); 
    }



    // (Alternate method to show logged-in user's posts.)
    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();
        return view('welcome.post', compact('posts'));  
    }
    
    // Show the form to create a new post.
    public function create()
    {
        return view('welcome.create');
    }

    // Store a new post in the database.
    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')
                         ->with('error', 'Please log in to create a post.');
    }

    $request->validate([
        'posting' => 'required|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    Post::create([
        'user_id' => auth()->id(),
        'user_name' => auth()->user()->name,  
        'posting' => $request->posting,
        'image' => $imagePath,
    ]);

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
 }
       // Show the form to edit an existing post.
       public function edit($id)
       {
           $post = Post::findOrFail($id);
           // Ensure the authenticated user is the owner of the post.
           if ($post->user_id !== Auth::id()) {
               abort(403, 'Unauthorized action.');
           }
           return view('welcome.edit', compact('post'));
       }
      
       
       // Update an existing post in the database.
    public function update(Request $request, $id)
    {
        $request->validate([
            'posting' => 'required|string|max:1000',
        ]);
    
        $post = Post::findOrFail($id);
        // Ensure the authenticated user is the owner of the post.
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $post->update([
            'posting' => $request->posting,
        ]);
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }
    
    // Delete a post from the database.
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        // Ensure the authenticated user is the owner of the post.
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}