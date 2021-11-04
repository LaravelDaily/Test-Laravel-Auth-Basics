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
        $updateFields = $request->only('name', 'email');

        if ($request->has('password')) {
            $updateFields['password'] = Hash::make($request->password);
        }

        auth()->user()->update($updateFields);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
