<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UserAccountController;
use App\Http\Middleware\SessionUserAccountMW;

// User Authentication Routes (directly accessible without layout wrapper)
Route::get('/login', [UserAccountController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserAccountController::class, 'login'])->name('login.submit');
Route::get('/logout', [UserAccountController::class, 'logout'])->name('logout');

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Registration Routes (directly accessible without layout wrapper)
Route::get('/register', [UserAccountController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserAccountController::class, 'register'])->name('register.submit');

// Password Update Routes
Route::get('/update-password', [UserAccountController::class, 'showUpdatePasswordForm'])->name('password.update');
Route::post('/update-password', [UserAccountController::class, 'updatePassword'])->name('password.update.submit');

// Protected Routes (require user session)
Route::middleware([SessionUserAccountMW::class])->group(function () {
    // Dashboard
    Route::get('/dashboard', [UserAccountController::class, 'dashboard'])->name('dashboard');

    // Admin Routes (these would typically have additional admin middleware)
    Route::prefix('admin')->group(function () {
        Route::get('/users', [UserAccountController::class, 'index'])->name('admin.users');
        Route::get('/users/create', [UserAccountController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserAccountController::class, 'store'])->name('admin.users.store');
    });
    
    // Moving all other routes inside the protected middleware group
    // Maintenance page route
    Route::get('/maintenance', [PageController::class, 'maintenance'])->name('maintenance');

    // Profile page
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    // Contact form routes
    Route::get('/contactus', function () {
        return view('contactus');
    })->name('contactus');
    Route::post('/contactus', [PageController::class, 'store'])->name('contact.submit');

    // About Us page
    Route::get('/aboutus', function () {
        return view('aboutus');
    })->name('aboutus');

    // Pattern and conditional logic routes
    Route::get('/conditional/{grade?}', [PageController::class, 'conditional'])->name('conditional');
    Route::get('/pattern', [PageController::class, 'pattern'])->name('pattern');
    Route::get('/patternn/{rows?}', function ($rows = 5) {
        return view('pattern', compact('rows'));
    })->name('pattern.rows');

    // Redirect routes
    Route::get('/try', [RedirectController::class, 'showMessage'])->name('RedirectIndex');
    Route::get('/redirectme', function () {
        return redirect()->route('RedirectIndex', ["message" => "This is my message"]);
    });
    Route::get('/showSomething/{message}', [RedirectController::class, 'showSomething'])->name('showSomething');
    Route::get('/showSomething', [RedirectController::class, 'showSomething']);

    // Student CRUD routes
    Route::resource('/students', ManageStudentController::class);
});
