<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email',
            'password_confirmation' => 'same:password'
        ]);
        
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        
        if($request->password != "")
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
