<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('auth.profile')->with(['user' => $user]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request=$request->validated();
        $user = auth()->user();
        if(isset($request['password'])) {
            $user->password = Hash::make($request['password']);
        }
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
