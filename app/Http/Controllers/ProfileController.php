<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        }
        auth()->user()->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
