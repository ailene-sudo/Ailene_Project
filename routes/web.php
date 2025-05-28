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

// Show welcome page at root
Route::get('/', function () {
    return view('welcome');
});

// Registration Routes moved to protected routes

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
        Route::get('/users/{id}/edit', [UserAccountController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [UserAccountController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{id}', [UserAccountController::class, 'destroy'])->name('admin.users.destroy');
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
    Route::patch('/students/{student}/toggle-status', [ManageStudentController::class, 'toggleStatus'])->name('students.toggle-status');
});
