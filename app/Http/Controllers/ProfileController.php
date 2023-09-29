<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set



        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->user()->isDirty('password')) {
            $request->user()->password = Hash::make($request->user()->password);
        }

        $request->user()->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
