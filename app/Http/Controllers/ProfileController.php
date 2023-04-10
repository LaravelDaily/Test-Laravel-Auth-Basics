<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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

        $user = Auth::user();

        if (!empty($request['password'])) {
            $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
                'password' => 'required|confirmed|min:8'
            ]);
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
        } else {
            $request->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email'],
            ]);
            $user->name = $request['name'];
            $user->email = $request['email'];
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
