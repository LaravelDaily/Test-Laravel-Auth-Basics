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
        auth()->user()->name->update();
        auth()->user()->email->update();
        if (isset(auth()->user()->password)) {
            # code...
            auth()->user()->password->update();
        }
        auth()->user()->email->update();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
