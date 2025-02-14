<?php
// app/Http/Controllers/ReactionController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reaction;

class ReactionController extends Controller
{
    public function store(Request $request, $postId)
    {
        // Manually check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to react.');
        }

        $user = Auth::user();
        $userId = $user->id;

        // Check if the user already reacted to this post
        $existingReaction = Reaction::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($existingReaction) {
            return redirect()->back()->with('error', 'You already reacted to this post.');
        }

        Reaction::create([
            'user_id'   => $userId,
            'user_name' => $user->name,
            'post_id'   => $postId,
        ]);

        return redirect()->back()->with('success', 'Reaction added successfully!');
    }
}
