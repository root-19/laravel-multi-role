<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    Comment::create([
        'post_id'   => $postId,
        'user_id'   => Auth::id(),
        'user_name' => Auth::user()->name,
        'comment'   => $request->comment,
    ]);

    return redirect()->back()->with('success', 'Comment added successfully!');
}
}