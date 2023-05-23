<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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

        // Get the authenticated user
        /** @var User $user */
        $user = $request->user();

        // Update the name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update the password if it is set
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the changes to the user
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
