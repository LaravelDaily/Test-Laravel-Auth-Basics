<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user = \App\Models\User::where('id',\auth()->id())->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if( $request->has('password'))
        {
            $user->update(['password'=>bcrypt($request->input('password'))]);
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
