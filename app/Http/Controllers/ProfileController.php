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

    public function update(ProfileUpdateRequest $request,User $user)
    {

        //$user = auth()->user();
        $user->update(
            $request->validated()
        );

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
