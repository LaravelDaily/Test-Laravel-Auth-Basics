<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::view('/secretpage', 'secretpage')->middleware(['auth', 'verified'])->name('secretpage');

Route::view('/verysecretpage', 'verysecretpage')->middleware('password.confirm')->name('verysecretpage');

require __DIR__ . '/auth.php';
