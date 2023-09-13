<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

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
        $updateData = ["name"=>$request->name,
                        "email"=>$request->email];
        if(isset($request->password)){
            array_merge($updateData,array("password"=>$request->name));
        }
        User::where('id',  $request->id)
            ->update($updateData);
        
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}