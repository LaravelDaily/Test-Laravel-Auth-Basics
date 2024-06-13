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
        $user = auth()->user();

    // Update the user's name and email
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Check if the password field is filled
    if ($request->filled('password')) {
        // Hash and update the password
        $user->password = bcrypt($request->input('password'));
    }

    // Save the user changes
    $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
