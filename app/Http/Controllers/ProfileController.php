<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rules;
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

        if(!Auth::check())
            to_route('login');

        if($request->password !== null ) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            
            Auth::user()->update([
                'name' => $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
            ]);    
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            Auth::user()->update([
                'name' => $request->name,
                'email'=> $request->email
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
