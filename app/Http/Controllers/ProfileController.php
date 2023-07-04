<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $users = User::all();
        
        return view('auth.profile', compact('users'));
        
    }

    public function update(ProfileUpdateRequest $request )
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
    
        $user = Auth::user();
    
        $user->name = Request::input('name');
        $user->email = Request::input('email');
    
        if ( ! Request::input('password') == '')
        {
            $user->password = bcrypt(Request::input('password'));
        }
    
        $user->save();
    
        

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}