<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show()
    {
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set
        $fields = $request->only(['name', 'email']);
        $user = Auth::user();
        $user->name = $fields['name'];
        $user->email = $fields['email'];
        if (!empty($request->password))
            $user->password = bcrypt($request->password);
        $user->update();
        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
