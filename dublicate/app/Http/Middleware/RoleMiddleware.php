<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect guests to login
        }

        $user = Auth::user();

        // Allow only 'admin' and 'user' roles
        if ($user->role === 'admin') {
            return redirect()->route('welcome'); // Redirect admin
        } elseif ($user->role === 'user') {
            return redirect()->route('dashboard'); // Redirect user
        }

        // If the role is neither 'admin' nor 'user', log out and deny access
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Your account is not allowed to log in.',
        ]);
    }
}
