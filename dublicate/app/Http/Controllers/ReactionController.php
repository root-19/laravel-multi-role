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
        $userId = Auth::id();
        
        // Suriin kung may existing reaction na ang user sa post na ito
        $existingReaction = Reaction::where('post_id', $postId)
            ->where('user_id', $userId)
            ->first();

        if ($existingReaction) {
            return redirect()->back()->with('error', 'You already reacted to this post.');
        }

        Reaction::create([
            'user_id'   => $userId,
            'user_name' => Auth::user()->name,
            'post_id'   => $postId,
        ]);

        return redirect()->back()->with('success', 'Reaction added successfully!');
    }
}
