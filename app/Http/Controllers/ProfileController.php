<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
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

        $data = Auth::user();

        $request->validate([
            "name"=>"filled|max:20|unique:users,name",
            "email"=>"email|unique:users,email",
            "password"=>"min:8|confirmed"
        ]);

        $data->name = $request->name;
        $data->email = $request->email;
        $password = $request->password;
        if($password){
            $data->password = Hash::make($password);
        }

        $data->update();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
