<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
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
        $credentials = $request->validate([
            'email'=>['email'],
            'name'=>'max:12',
            'password',
            'password_confirmation'
        ]);
        if($request->password!="")
            if ($request->password == $request->password_confirmation)
                $credentials['password'] = bcrypt($request->password);
            else
                 return back()->withErrors(['password'=>'the password doesn\'t match']);

        print_r(auth()->user()->update($credentials));


        return  redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
