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
        return $next($request); // Allow guests to proceed (e.g., to login/register)
    }

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('welcome'); // Redirect admin
    }

    if ($user->role === 'user') {
        return redirect()->route('dashboard'); // Redirect user
    }

    // Logout unrecognized roles
    Auth::logout();
    return redirect()->route('login')->withErrors([
        'email' => 'Your account is not allowed to log in.',
    ]);
}
}