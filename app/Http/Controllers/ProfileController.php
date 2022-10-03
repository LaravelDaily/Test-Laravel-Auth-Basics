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
        $user =Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        if (!($request['password']== ''))
        { 
            $user->password = bcrypt($request['password']);
        };
        $user->save();
        

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }

}

