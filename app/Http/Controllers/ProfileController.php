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
        $user = Auth::user();
        if ($request->has('password')) {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);
        } else {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
