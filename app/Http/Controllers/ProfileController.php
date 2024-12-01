<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    // KunYuChang
    public function update(ProfileUpdateRequest $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Update name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Check if a new password is provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Save the updated user information to the database
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
