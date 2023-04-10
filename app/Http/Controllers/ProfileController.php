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

        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
