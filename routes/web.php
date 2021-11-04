<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
Route::put('profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');

Route::view('/secretpage', 'secretpage')->middleware('verified')->name('secretpage');

Route::view('/verysecretpage', 'verysecretpage')->middleware('password.confirm')->name('verysecretpage');

require __DIR__ . '/auth.php';
