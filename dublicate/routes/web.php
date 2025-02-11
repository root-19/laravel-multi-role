<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
});

// Redirect users based on their role after login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.admin');
        } elseif ($user->role === 'user') {
            return view('welcome.welcome'); // Redirect to user dashboard
        }

        // If role is not 'admin' or 'user', logout and deny access
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Your account is not authorized.',
        ]);
    })->name('dashboard');

    Route::get('/grade', [GradeController::class, 'index'])->name('grade');
    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
