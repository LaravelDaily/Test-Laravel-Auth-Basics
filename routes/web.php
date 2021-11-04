<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('users', [UserController::class, 'index'])->name('users.index');

// Task: profile functionality should be available only for logged-in users
Route::get('profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
Route::put('profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::view('/secretpage', 'secretpage')->middleware('verified')->name('secretpage');

// Task: this "/verysecretpage" URL should ask user for verifying their password once again
// You need to add some middleware here
Route::view('/verysecretpage', 'verysecretpage')
     ->name('verysecretpage');

require __DIR__ . '/auth.php';
