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
       if($request->password != null){
              $request->user()->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
              ]);
       }
       else {
                $request->user()->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
       }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
