<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $data = $request->validated();
        if (array_key_exists('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }
        auth()->user()->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
