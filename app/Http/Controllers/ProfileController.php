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

        if ($request->has('password')) {
            $request->user()->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        } 
        else {
            $request->user()->update($request->only('name', 'email'));
        }
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
