<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $user = Auth::user();
        //dd($request->password);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password && $request->password_confirmation) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        /* 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique('users')->ignore(Auth::user())],
            'password' => ['sometimes', 'required_with:old_password', 'string', 'confirmed', 'min:8'], */

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
