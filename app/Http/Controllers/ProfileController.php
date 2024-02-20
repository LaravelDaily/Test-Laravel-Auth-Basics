<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Auth\User as AuthUser;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        //$user = User: :find(auth()->user()->id);
        //$user = $request->user();
        $user = auth()->user();
        //        $user->name = $request->input('name');
        //        $user->email = $request->input('email');
        $inputs = $request->only('name', 'email');
        // Also, update the password if it is set
        if ($request->has('password')) {
            $inputs['password'] = Hash::make($request->password);
            //            $user->password = Hash::make($request->input('password'));
        }
        $user->update($inputs);
        //        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
