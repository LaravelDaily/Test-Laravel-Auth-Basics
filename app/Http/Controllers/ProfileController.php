<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

        if ($request->has('password')){
            $request['password'] = Hash::make($request->input('password'));
        }

        auth()->user()->update($request->all());

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
