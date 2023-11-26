<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => ['confirmed', Password::defaults()],
            'password_confirmation' => '',
        ]);
        $user = auth()->user();
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);
        if(strlen($validated['password'])) {
            $user->password = Hash::make($validated['password']);
            $user->save();
        }
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
