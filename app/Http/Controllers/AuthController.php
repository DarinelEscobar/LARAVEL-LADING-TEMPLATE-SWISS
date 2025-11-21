<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(){
        $section = 1;
        if (Auth::check()) return redirect()->route('dashboard');
        return view('pages.auth',compact('section'));
    }

    public function logout(Request $request){
        Auth::logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showForgetPasswordForm()
    {
        $section = 2;
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('pages.auth',compact('section'));
        }
    }

    public function showResetPasswordForm($token)
    {
        $section = 3;
        return view('pages.auth',compact('section','token'));
        // return view('pages.forget-password-link', ['token' => $token]);
    }
}
