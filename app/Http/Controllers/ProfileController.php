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
        $user = $request->user(); // Get the authenticated user

        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update the user's password if it is set
        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
