<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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


        $password = !empty($request->password) ? $request->password : null;
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if (!empty($request->password))
            $data['password']= Hash::make($request->password);

        User::where( 'email' ,$request->email)->update($data);

        return redirect()->route('profile.update')->with('success', 'Profile updated.');
    }
}
