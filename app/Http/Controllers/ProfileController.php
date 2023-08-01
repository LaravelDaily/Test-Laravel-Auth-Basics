<?php

namespace App\Http\Controllers;
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
        $user = Auth::user()
        $user->name = $request['name'];
        $user->email = $user->$request['email'];
        if (isset($request['password'])
            $user = $user->$request['password'];
        $user->save()
        
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
