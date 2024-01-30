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
        // $user = User::findOrFail(Auth::id());
        // $user->update($request->only('name','email'));
        // if($request->input('password')){
        //     $user->update([
        //         'password' => Hash::make($request->input('password'))
        //     ]);
        // }
        auth()->user()->update($request->only('name', 'email'));

        if ($request->input('password')) {
            auth()->user()->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
