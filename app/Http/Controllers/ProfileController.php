<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile', ['user' => auth()->user()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        auth()->user()->update(
            array_merge(
                $request->only(['name', 'email']),
                ($request->has('password')
                    ? ['password' => Hash::make($request->password)]
                    : []
                )
            )
        );

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
