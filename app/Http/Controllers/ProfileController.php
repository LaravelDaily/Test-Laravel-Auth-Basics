<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Auth;
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
        $password = isset($request->password) ? bcrypt($request->password):$user->password;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $password;
        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
