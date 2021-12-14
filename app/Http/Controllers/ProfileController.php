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
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
        
        $request->user()->update(
            $validated
        );

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
