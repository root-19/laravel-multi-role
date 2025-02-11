<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Create this Blade file in resources/views/admin/dashboard.blade.php
    }
}
