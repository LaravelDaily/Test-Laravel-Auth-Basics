<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('users', [UserController::class, 'index'])->name('users.index');

// Task 1: Profile functionality should be available only for logged-in users
Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Task 2: /secretpage URL should be visible only for those who verified their email
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/secretpage', 'secretpage')->name('secretpage');
});

// Task 3: /verysecretpage URL should ask the user for verifying their password once again
Route::middleware(['auth', 'password.confirm'])->group(function () {
    Route::view('/verysecretpage', 'verysecretpage')->name('verysecretpage');
});

require __DIR__.'/auth.php';
