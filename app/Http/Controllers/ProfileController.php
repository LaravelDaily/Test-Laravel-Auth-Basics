<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if (! is_null($request->password)) {
            $password = Hash::make($request->password);
            
            $user->update([
                'password' => $password,
            ]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
