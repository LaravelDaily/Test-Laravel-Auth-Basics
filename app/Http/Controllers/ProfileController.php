<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $inputs = $request->only(['name', 'email']);
        if ($request->has('password')) {
            $inputs['password'] = Hash::make($request->password);
        }
        $user->update($inputs);
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
