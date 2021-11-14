<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        $user = auth()->user();
        $data = $request->validated();

        if ($request->has('password')) {
            $data['password'] = Hash::make($request['password']);
        }

        // Also, update the password if it is set
        $user->update($data);


        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
