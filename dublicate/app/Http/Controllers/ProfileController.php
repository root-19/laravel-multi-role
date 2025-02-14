<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Logged-in user's profile
    public function profile()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('welcome.profile', compact('user'));
    }

    // Viewing another user's profile (read-only)
    public function visitedProfile($id)
    {
        $user = User::findOrFail($id); // Get the user by ID
        return view('welcome.visited-profile', compact('user'));
    }
  
    public function update(Request $request)
    {
        $user = auth()->user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
    
        // Update user information
        $user->name = $request->name;
        $user->bio = $request->bio;
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profilePath = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $profilePath;
        }
    
        // Handle cover photo upload
        if ($request->hasFile('cover_photo')) {
            $coverPath = $request->file('cover_photo')->store('covers', 'public');
            $user->cover_photo = $coverPath;
        }
    
        $user->save();
    
        return back()->with('success', 'Profile updated successfully!');
    }
    
}
