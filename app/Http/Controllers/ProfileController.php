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
        $validated = $request->validated();

        if ($request->has('password')){
            $validated["password"] = Hash::make($validated["password"]);
        }

        auth()->user()->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
