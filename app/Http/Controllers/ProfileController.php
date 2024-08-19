<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        // Update the name and email
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Update the password if it's provided
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Save the changes
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
