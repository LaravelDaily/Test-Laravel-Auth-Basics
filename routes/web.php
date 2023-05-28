<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home')->name('home');

Route::get('users', [UserController::class, 'index'])->name('users.index');

// Task: profile functionality should be available only for logged-in users
Route::get('profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
Route::put('profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');


// Task: this "/secretpage" URL should be visible only for those who VERIFIED their email
// Add some middleware here, and change some code in app/Models/User.php to enable this
Route::view('/secretpage', 'secretpage')
    ->name('secretpage')->middleware(['verified']);

// Task: this "/verysecretpage" URL should ask user for verifying their password once again
// You need to add some middleware here
Route::view('/verysecretpage', 'verysecretpage')
    ->name('verysecretpage');

require __DIR__.'/auth.php';
