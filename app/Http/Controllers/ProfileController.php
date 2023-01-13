<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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
        if ($request->has('password')) {
            $input = $request->only(['name', 'email']);
            $input['password'] = Hash::make($request->password);
            User::where('id', auth()->user()->id)
                ->update($input);
        } else {
            User::where('id', auth()->user()->id)
                ->update($request->only(['name', 'email']));
        } 

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
