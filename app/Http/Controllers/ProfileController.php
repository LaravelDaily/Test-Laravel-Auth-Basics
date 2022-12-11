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
        $data =    $request->validate([
            'name'  =>  'required',
            'email' =>  'required'
        ]);

        // Also, update the password if it is set
        if($request->has('password')){
            $data['password']   =   Hash::make($request->input('password'));
        }

        $request->user()->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
