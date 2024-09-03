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


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    // Task: profile functionality should be available only for logged-in users
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Task: this "/secretpage" URL should be visible only for those who VERIFIED their email
    // Add some middleware here, and change some code in app/Models/User.php to enable this
    Route::view('/secretpage', 'secretpage')
        ->name('secretpage')
        ->middleware('verified');

    // Task: this "/verysecretpage" URL should ask user for verifying their password once again
    // You need to add some middleware here
    Route::view('/verysecretpage', 'verysecretpage')
        ->name('verysecretpage')->middleware(['password.confirm']);;

    Route::get('/confirm-password', function () {
        return view('auth.confirm-password');
    })->middleware('auth')->name('password.confirm');

    Route::post('/confirm-password', function (Request $request) {
        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }
     
        $request->session()->passwordConfirmed();
     
        return redirect()->intended();
    })->middleware(['throttle:6,1']);
});

require __DIR__.'/auth.php';
