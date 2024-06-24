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
        // Task 4: fill in the code here to update name and email
        // Also, update the password if it is set
        $user_data = $request->validated();
        if (isset($user_data['password']))
        {
            $user_data['password'] = bcrypt($user_data['password']);
        }
        auth()->user()->update($user_data);
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
