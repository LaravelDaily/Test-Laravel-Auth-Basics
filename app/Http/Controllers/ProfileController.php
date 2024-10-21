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
        // Update the name and email
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // If the password is set, update the password
        if ($request->filled('password')) {
            $data = array_merge($data, [
                'password' => Hash::make($request->password),
            ]);
        }
        auth()->user()->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
