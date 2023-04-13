<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

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
        $userDetails = auth()->user();
        $user = User::find($userDetails->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
