<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        auth()->user()->update($request->only('name', 'email'));

        if ($request->has('password')) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
