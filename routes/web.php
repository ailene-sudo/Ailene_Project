<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\RedirectController;

// Maintenance page route
Route::get('/maintenance', [PageController::class, 'maintenance'])->name('maintenance');

// Home/Profile
Route::get('/', function () {
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

// Profile page
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

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
