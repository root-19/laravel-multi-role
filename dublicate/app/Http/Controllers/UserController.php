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
}
