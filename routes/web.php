<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('users', [UserController::class, 'index'])->name('users.index');

// Task: profile functionality should be available only for logged-in users
Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

// Task: this "/secretpage" URL should be visible only for those who VERIFIED their email
// Add some middleware here, and change some code in app/Models/User.php to enable this
Route::view('/secretpage', 'secretpage')
     ->name('secretpage');

// Task: this "/verysecretpage" URL should ask user for verifying their password once again
// You need to add some middleware here
Route::view('/verysecretpage', 'verysecretpage')
     ->name('verysecretpage');

require __DIR__ . '/auth.php';
