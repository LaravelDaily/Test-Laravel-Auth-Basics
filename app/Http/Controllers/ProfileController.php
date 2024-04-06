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
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        // Also, update the password if it is set
        if ($request->password) {
            $request->user()->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
