<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('profile.show')->withErrors($validator)
            ->withInput();
        }

        $data = $request->all();

        $update_data = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        if( !empty( $data['password_confirmation'] ) ){
            $update_data['password'] =  $data['password_confirmation'];
        }

        User::find($data['row_id'])->update($update_data);

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
