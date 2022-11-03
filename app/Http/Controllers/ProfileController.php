<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update( ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
       $data = $request->only(['name', 'email']);
       
    //    If password is set, update it
        if($request->password){
            $data['password'] = Hash::make($request->password) ;
        }
        auth()->user()->update($data);       
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
