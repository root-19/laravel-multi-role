<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import the User model

class UserController extends Controller
{
    // Fetch all users and pass them to the welcome page
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('welcome.welcome', compact('user')); // Pass users to the Blade template
    }

    // Show a single user's profile
    public function show(User $user)
    {
        return view('welcome.profile', compact('user'));
    }
    public function visitedProfile($id)
    {
        $user = User::findOrFail($id); // Get the user by ID
        return view('visited-profile', compact('user'));
    }
    public function searchUser(Request $request)
    {
        $query = $request->input('q');
    
        if ($request->ajax()) {
            $users = User::where('name', 'LIKE', "%{$query}%")->get();
            return response()->json($users); // Return JSON for AJAX
        }
    
        $users = User::where('name', 'LIKE', "%{$query}%")->get();
        return view('welcome.search-user', compact('users', 'query')); // Return the normal view
    }    

    public function viewProfile($id)
    {
        $user = User::findOrFail($id);
        return view('welcome.visited-profile', compact('user'));
    }
}
