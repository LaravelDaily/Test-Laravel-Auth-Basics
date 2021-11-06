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
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        $validated=$request->validated();

        if ($request->has('password')) {
            $validated['password']=Hash::make($request->get('password'));
        }

        auth()::user()->update($validated);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
