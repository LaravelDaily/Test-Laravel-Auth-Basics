<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->only('name', 'email');
        // Also, update the password if it is set
        if($password = $request->get('password')) {
            $data['password'] = bcrypt($password);
        }
        auth()->user()->update($data);

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profile updated.');
    }
}
