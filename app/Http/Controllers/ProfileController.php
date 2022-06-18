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

        $this->validate($request,[

        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
    
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if(!empty($request->input('password'))){

            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        
        
        

        
        

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
