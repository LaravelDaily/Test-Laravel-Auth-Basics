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
        $attributes = $request->toArray();
        if ($request->has('password')) {
            $attributes['password'] = bcrypt($request->password);
        }
        auth()->user()->update($attributes);
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
