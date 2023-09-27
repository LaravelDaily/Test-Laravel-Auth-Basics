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
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($password)) {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
