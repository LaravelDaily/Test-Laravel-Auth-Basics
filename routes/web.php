<?php

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

Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

Route::group(['middleware' => 'auth'], function(){
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::view('/secretpage', 'secretpage')
        ->middleware('verified')
        ->name('secretpage');
    Route::view('/verysecretpage', 'verysecretpage')
        ->middleware('password.confirm')
        ->name('verysecretpage');
});

require __DIR__.'/auth.php';
