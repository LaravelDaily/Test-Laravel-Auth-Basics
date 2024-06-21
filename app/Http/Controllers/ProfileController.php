<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

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

        $request->user()->update([
            'name'  => $validated['name'],
            'email' => $validated['email']
        ]);

        if ($validated['password']) {
            $new_password = Hash::make($validated['password']);
            $request->user()->update(['password' => $new_password]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
