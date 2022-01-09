<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
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

        // Update name and email
        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        if ($request->input('password')) {
            auth()->user()->update([
                'password' => Hash::make($request->input('password'),)
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
