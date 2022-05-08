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
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $data = $request->validated();
        $user = auth()->user();
        if ($request->password) {
            $user->password = Hash::make($data['password']);
        }
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->update();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
