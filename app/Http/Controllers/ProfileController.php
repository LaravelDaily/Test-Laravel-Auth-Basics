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
        $user = User::findOrFail(Auth::user()->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if(!empty($request->input('password_confirmation'))) {
            $new_password = bcrypt($request->input('password_confirmation'));
            $user->password = $new_password;
            $user->save();
        }
        

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
