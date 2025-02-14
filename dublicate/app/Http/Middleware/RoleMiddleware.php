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
            return redirect()->route('/'); 
        }

        $user = Auth::user();

        // Only allow users with 'admin' or 'user' roles
        if (!in_array($user->role, ['admin', 'user'])) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'Your account is not allowed to log in.',
            ]);
        }

        // Allow the request to proceed
        return $next($request);
    }
    
}
