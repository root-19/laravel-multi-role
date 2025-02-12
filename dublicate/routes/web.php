<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Authentication Controllers
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\LogoutController;

// Other Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Routes accessible to everyone without authentication.
|
*/

// Homepage
Route::get('/', function () {
    return view('index');
})->name('index');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
|
| Routes accessible only to guests (not logged in).
|
*/
Route::middleware('guest')->group(function () {
    // Registration page
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    // Login page
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Routes that require the user to be authenticated.
|
*/
Route::middleware('auth')->group(function () {
    // Dashboard: if user is admin show admin view, else show all posts
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return view('admin.admin');
        } else {
            // Calls the "allPosts" method on the PostController
            return app()->call('App\Http\Controllers\PostController@allPosts');
        }
    })->name('dashboard');

    // Welcome page (post index) for authenticated users
    Route::get('/welcome', [PostController::class, 'index'])->name('welcome');

    // Post routes within auth group (note: duplicate definitions appear later)
    Route::get('/post', [PostController::class, 'index'])->name('post');
    Route::get('/create', [PostController::class, 'index'])->name('create');

    // Profile routes for authenticated users
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Post and Dashboard Routes (Additional Declarations)
|--------------------------------------------------------------------------
|
| The following routes are defined outside middleware groups.
| Note that some routes (and even route names) are repeated intentionally.
|
*/

// Dashboard alternative route (note: same name 'dashboard' as above)
Route::get('/all-posts', [PostController::class, 'dashboard'])->name('dashboard');

// Post index routes (some duplicates)
Route::get('/posts', [PostController::class, 'index'])->name('post');
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('/post', [PostController::class, 'index'])->name('posts.index');

// Create and store routes for posts
Route::get('/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Additional welcome routes for posts (duplicate of /welcome)
Route::get('/welcome', [PostController::class, 'index'])->name('welcome.post');

// Alternative create and store routes for posts (duplicate routes with different names)
Route::get('/posts/create', [PostController::class, 'create'])->name('welcome.create');
Route::post('/posts', [PostController::class, 'store'])->name('welcome.store');

// Edit, update, and delete routes for a specific post
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

/*
|--------------------------------------------------------------------------
| Authentication Routes File
|--------------------------------------------------------------------------
|
| The following file contains additional authentication routes.
|
*/
require __DIR__.'/auth.php';
