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
        $data = [
            'name'=>$request->input('name'),
            'email'=>$request->input('email')
        ];
        if($request->has('password'))
            $data = [
                'password'=>bcrypt($request->input('password'))
            ];
        Auth::user()->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
