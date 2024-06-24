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
        $data = $request->validated();

        $user = auth()->user();

        $user->name = $data['name'];
        $user->email = $data['email'];

        // Also, update the password if it is set
        if(isset($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
