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
        $payload = $request->validated();
        if (isset($payload['password'])) {
            $payload['password'] = Hash::make($payload['password']);
        }
        auth()->user()->update($payload);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
