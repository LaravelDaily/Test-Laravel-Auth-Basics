<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        // Get the authenticated user
        $user = auth()->user();
        
        // Update the user's name and email
        $user->name = $request->name;
        $user->email = $request->email;
        
        // Update the password if it is set
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }   
        
        // Save the updated user data
        $user->save();
        
        // Redirect back to the profile page with a success message
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
