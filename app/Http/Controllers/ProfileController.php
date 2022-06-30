<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        auth()->user()->update($request->validated());
        // Also, update the password if it is set

        if ($request->has('password')) {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
        }



        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
