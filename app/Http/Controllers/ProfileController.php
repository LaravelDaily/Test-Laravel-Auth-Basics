<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
