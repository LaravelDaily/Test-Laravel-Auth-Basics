<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Get validated data array
        $data = $request->validated();

        // Set password in array if needed
        if ($request->has('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        // Update user
        $request->user()->update($data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
