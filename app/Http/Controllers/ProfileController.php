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
        $user = auth()->user();

        if ($user) {
            $user->email = $request->email;
            $user->name = $request->name;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
        }        // Also, update the password if it is set

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
