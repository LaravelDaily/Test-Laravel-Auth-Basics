<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException as ME;
use DB;
use Validator;

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

        DB::beginTransaction();

        try {
            $user = Auth::user();
                
                $user->name = $request->name;
                $user->email = $request->email;

                if (isset($request->password)) {
                    $user->update([
                        "password" => Hash::make($request->password),
                    ]);
                }
                $user->update();
                DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'errors' => ['Something went wrong'],
                ],
                500
            );
        }

        return redirect()
            ->route('profile.show')
            ->with('success', 'Profile updated.');
    }
}
