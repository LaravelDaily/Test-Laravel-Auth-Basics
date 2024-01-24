<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('auth.profile', ['user' => $user]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        // $id = Auth::id();
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if($request->validated('password')) {
            $user->update(['password' => Hash::make($request->validated('password'))]);
        }
        $user->save();
        // dd($request->name);
        // dd($request->input('name'));
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
