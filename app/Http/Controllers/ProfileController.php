<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rules;
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

        $validated = $request->validate([
            'current_password' => ['bail', 'nullable', 'current_password'],
            'password' => ['bail', 'nullable', Rules\Password::min(8)->numbers()->symbols()->mixedCase(), 'confirmed'],
        ]);

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if($request->has('password')){
            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);
        }
        

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
