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

        $incomingFields = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'min:8'
        ]);

        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['email'] = strip_tags($incomingFields['email']);

        $user->name = $incomingFields['name'];
        $user->email = $incomingFields['email'];

        if (isset($incomingFields['password'])) {
            $incomingFields['password'] = bcrypt(strip_tags($incomingFields['password']));
            $user->password = $incomingFields['password'];
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
