<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Controllers\Hash;

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
        if(! empty($request->password)){
           auth()->user()->update([
            'name' => $request->name,
            "email" => $request->email,
            "password" => Hash::$request->passowrd
            ]); 
        } else {
            auth()->user()->update([
                'name' => $request->name,
                "email" => $request->email,
                ]);
        }
        
        
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
