<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth->user();
        $user->update[(
            'name' => $request->name;
             'email' => $request->email;
        )] 
     if (isset($request['password']))
            $user->update([ 'password' => Hash::make($request['password']) ]);
            

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
