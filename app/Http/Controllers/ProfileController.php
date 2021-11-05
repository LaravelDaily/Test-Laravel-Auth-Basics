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
        $user = Auth::user();
        $validator=$request->validated();
        if($request->has('password'))
        {
            $validator['password'] = bcrypt($request->input('password'));
        }
        $user->update($validator);
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
