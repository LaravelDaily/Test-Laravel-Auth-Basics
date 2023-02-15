<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile', ['user' => auth()->user()]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email

        //this will update user but will not change authenticated user for which test is created
        /*
        User::whereId(auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        */
        
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        // Also, update the password if it is set
        if ($request->password && $request->password_confirmation) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
