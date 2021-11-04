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
        // Also, update the password if it is set
        auth()->user()->update($request->only('name', 'email'));

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
