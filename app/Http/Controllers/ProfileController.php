<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\{Auth, Hash};

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $valid = $request->validated();
        if ($request->password) {
            $valid['password'] = Hash::make($valid['password']);
        }

        $request->user()->update($valid);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
