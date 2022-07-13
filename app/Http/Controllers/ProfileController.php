<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;

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
        $user = User::findOrFail(Auth::id());
        $user->update($request->only(['name', 'email']));
        if($request->filled('password')){
            $user->update(['password' => bcrypt($request->password)]);
        }
        //  dd(Auth::attempt([
        //     'email' => $request->email,
        //     'password' => 'newpassword'
        // ]));

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
