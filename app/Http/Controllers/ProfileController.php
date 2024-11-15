<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
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
        $user = User::find(Auth::user()->id); 

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',  
            'password' => 'confirmed',
        ]);
        
        // dd($user->password);
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]); 

        if($request->filled('password')){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
