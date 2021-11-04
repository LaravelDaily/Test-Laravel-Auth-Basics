<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Task: fill in the code here to update name and email
        $profileData = $request->validated();

        // Also, update the password if it is set
        if ($request->has('password')){
            $profileData['password'] = Hash::make($profileData['password']);
        }

        auth()->user()->update($profileData);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
