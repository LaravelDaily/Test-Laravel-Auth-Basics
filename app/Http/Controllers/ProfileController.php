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
        
        // Get the currently authenticated user
        $user = auth()->user();

        // Update the name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Check if a password is set, and update it if so
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes to the user
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
