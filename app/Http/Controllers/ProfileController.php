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
        if($request->has('password')){
            // Task: fill in the code here to update password
            auth()->user()->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }

        auth()->user()->update($request->only('name', 'email'));
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
