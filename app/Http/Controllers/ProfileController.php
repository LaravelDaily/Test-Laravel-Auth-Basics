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
        $user->name = $request->validated()['name'];
        $user->email = $request->validated()['email'];
        if(array_key_exists('password',$request->validated())){
            $user->password = bcrypt($request->validated()['password']);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
