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
        $user = auth()->user();
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        // dd(auth()->user);
        $user->name = $request->name;
        $user->email = $request->email;

        if (isset($request->password, $request->password_confirmation)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        // dd($user->password);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
