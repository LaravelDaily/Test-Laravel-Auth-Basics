<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Exception;

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

        try {
            $user = Auth::user();
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->has('password')) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }
            $user->update();
        } catch (Exception $error) {
            return response()->json(
                [
                    'error' => 'Something went wrong'
                ],
                500
            );
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
