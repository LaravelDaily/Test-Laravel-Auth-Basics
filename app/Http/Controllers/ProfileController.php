<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
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
        $form = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email']
        ]);

        if(isset($request['password'])){
            $form['password'] = Hash::make($request['password']);
        }
        auth()->user()->update($form);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
