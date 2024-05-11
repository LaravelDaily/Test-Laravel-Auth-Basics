<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function store (Request $request){
        $credintials = $request->validate([
            'email'=>['required','email'],
            'password'=>'required'
        ]);

        if(Auth::attempt($credintials)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        return back()->withErrors([
            'email'=>'sorry the provided credentials are not correct'
        ])->onlyInput('email');
    }
}
