<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Auth;
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
        $request->validated();

        $user = Auth::user();

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->has('password') ? Hash::make($request->get('password')) : Auth::user()->getAuthPassword()
        ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
