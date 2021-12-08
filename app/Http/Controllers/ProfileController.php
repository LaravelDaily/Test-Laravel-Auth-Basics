<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        
        $validation = $request->validated();
        $request->has('password') && $validation['password'] = Hash::make($request->password);
        auth()->user()->update($validation);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
