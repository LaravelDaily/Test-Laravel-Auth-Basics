<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email

/*        $formFields = [
          'name' => $request->name,
          'email' => $request->email,
        ];*/

        $formFields = $request->validated();
        $user = auth()->user();

        $user->name = $formFields['name'];
        $user->email = $formFields['email'];

        if (isset($formFields['password'])){
            $user->password = bcrypt($formFields['password']);
        }

        $user->save();

        // Also, update the password if it is set

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
