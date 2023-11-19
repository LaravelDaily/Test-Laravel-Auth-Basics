<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
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
        $user->update([
           'name'=>$request->safe()->name,
            'email'=>$request->safe()->email
        ]);

        if($request->filled('password')){
            $uesr->update([
                          'password'=>Hash::make($request->safe()->password)
            ]);
        }
        
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
