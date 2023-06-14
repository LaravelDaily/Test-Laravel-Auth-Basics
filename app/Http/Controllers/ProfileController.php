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
        $user = Auth::user();
        return view('auth.profile', ['user'=>$user]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        Auth::user()->update($request->validated());
        if ($request->password) {
            Auth::user()->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
