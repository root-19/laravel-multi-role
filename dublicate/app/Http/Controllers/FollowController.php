<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function toggleFollow(Request $request)
    {
        $userId = $request->user_id;
        $followerId = Auth::id();

        // Check if already following
        $follow = Follow::where('follower_id', $followerId)->where('following_id', $userId)->first();

        if ($follow) {
            // Unfollow
            $follow->delete();
            return response()->json(['status' => 'unfollowed']);
        } else {
            // Follow
            Follow::create([
                'follower_id' => $followerId,
                'following_id' => $userId
            ]);
            return response()->json(['status' => 'followed']);
        }
    }
}


// use Illuminate\Http\Request;
// use App\Models\Follow;
// use Illuminate\Support\Facades\Auth;

// class FollowController extends Controller
// {
//     public function toggleFollow(Request $request)
//     {
//         $userId = $request->user_id;
//         $followerId = Auth::id();

//         // Check if already following
//         $follow = Follow::where('follower_id', $followerId)->where('following_id', $userId)->first();

//         if ($follow) {
//             // Unfollow
//             $follow->delete();
//             return response()->json(['status' => 'unfollowed']);
//         } else {
//             // Follow
//             Follow::create([
//                 'follower_id' => $followerId,
//                 'following_id' => $userId
//             ]);
//             return response()->json(['status' => 'followed']);
//         }
//     }
// }

// }
