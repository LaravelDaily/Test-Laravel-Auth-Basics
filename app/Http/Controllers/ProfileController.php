<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {

        $validated = $request->validate([
            'current_password' => ['bail', 'nullable', 'current_password'],
            'password' => ['bail', 'nullable', Rules\Password::mixedCase()->numbers(), 'confirmed'],
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
