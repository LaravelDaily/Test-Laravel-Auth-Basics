<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $validated = $request->validated();
        if($request->has('password'))
        {
            $validated['password'] = bcrypt($request->input('password'));
        }
        auth()->user()->update($validated);
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
