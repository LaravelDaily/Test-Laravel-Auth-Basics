<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

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
        $validatedData = $request->validated();
        $user = Auth::user();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($request->has('password')) {
            $user->password = bcrypt($validatedData['password']);
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
