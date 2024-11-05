<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.signin');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $role = auth()->user()->role;
            if($role === 'admin'){
                return redirect()->intended('admindash');
            }elseif($role === 'employee'){
                return redirect()->intended('teacherdash');
            }elseif($role === 'customer'){
                return redirect()->intended('studentdash');
            }
        }else{
            return redirect('/')->with('failed', 'Email atau Password Salah');
        }
    }
}
