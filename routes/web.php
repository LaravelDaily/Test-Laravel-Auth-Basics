<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

// Task: profile functionality should be available only for logged-in users
Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Task: this "/secretpage" URL should be visible only for those who VERIFIED their email
// Add some middleware here, and change some code in app/Models/User.php to enable this
Route::view('/secretpage', 'secretpage')
    ->name('secretpage')->middleware('verified');    

// Task: this "/verysecretpage" URL should ask user for verifying their password once again
// You need to add some middleware here
Route::view('/verysecretpage', 'verysecretpage')
    ->name('verysecretpage')->middleware('password.confirm');;
require __DIR__.'/auth.php';