<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
          $request->validate([
            'name' => [ 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255'],
            'password' => [ 'confirmed', Password::min(8)->letters()],
        ]);
        $user =User::findOrFail(Auth::id());

        auth()->user()->update($request->validated());

        if($request->has('password')){
            $user->password = Hash::make($request->password);
        }
        $user->save();




        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
