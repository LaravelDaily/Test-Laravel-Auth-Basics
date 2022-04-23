<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
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
        // Also, update the password if it is set
        $validated = $request->validated();
        $user = Auth::user();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->update();
        
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
