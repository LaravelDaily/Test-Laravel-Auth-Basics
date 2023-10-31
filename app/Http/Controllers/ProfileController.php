<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

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
        $validateData = $request->validated();
        if($validateData)
        {
            $user = auth()->user();
    
            // Update user name and email
            $user->name = $request->input('name');
            $user->email = $request->input('email');
    
            // Update password if request has password
            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }
    
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
