<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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
        $user =  auth()->user();


        if ($request->password) {
            ($user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]));
        } else {
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        }


        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
