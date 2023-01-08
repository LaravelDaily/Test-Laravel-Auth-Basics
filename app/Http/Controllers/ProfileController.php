<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rules;

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
        $user = auth()->user();

        if ($request->password != Null)
        {
            $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()->letters()],
            ]);
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = Hash::make($request['password']);
            $user->save();
        }
        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255',
        ]);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
