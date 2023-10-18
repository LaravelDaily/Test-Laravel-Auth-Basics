<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        $data = $request->validated();

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = auth()->user();

        $user->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
