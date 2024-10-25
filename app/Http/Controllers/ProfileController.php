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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = ($request->password) ? bcrypt($request->password) : $user->getAuthPassword();
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
