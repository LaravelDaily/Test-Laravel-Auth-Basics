<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

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

        auth()->user()->update($request->validated());
        if ($request->has('password')) {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
        }


        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
