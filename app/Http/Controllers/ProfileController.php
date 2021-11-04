<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        // return auth()->user();
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
                auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // Also, update the password if it is set
        if ($request->password) {
            auth()->user()->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
