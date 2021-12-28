<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $user->name = $request->validated()['name'];
        $user->email = $request->validated()['email'];

        if (array_key_exists('password', $request->validated())) {
            $password = bcrypt($request->validated()['password']);
            $user->password =  $password;
        }

        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
