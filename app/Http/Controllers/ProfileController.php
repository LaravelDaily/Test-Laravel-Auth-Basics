<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $user = User::find(Auth::id())
            ->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
