<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller {
    public function show() {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $req) {
        $user = auth()->user();

        $user['email'] = $req->email;
        $user['name'] = $req->name;
        if ($req->password) {
            $user['password'] = bcrypt($req->password);
        }

        $user->save();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
