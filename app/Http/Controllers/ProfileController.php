<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
        $user=auth()->user();
        if($request->filled('password')){
            $request->password=Hash::make($request->password);
            $user->update($request->safe()->only(['name','email','password']));
        }
        else{
            $user->update($request->safe()->only(['name','email']));
        }
        

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
