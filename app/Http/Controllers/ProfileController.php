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
        $updateUser = Auth::user();
        $updateUser->name = $request->name;
        $updateUser->email = $request->email;
        if($request->filled('password')) {
            $updateUser->password = Hash::make($request->password);
        }
        $updateUser->save();
        // Also, update the password if it is set

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
