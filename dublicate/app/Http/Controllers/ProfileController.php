<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        // Update profile logic
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function destroy()
    {
        // Delete profile logic
        return redirect()->route('index')->with('success', 'Profile deleted.');
    }
}
