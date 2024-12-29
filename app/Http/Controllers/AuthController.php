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
                return redirect()->intended('admin-dash');
            }elseif($role === 'employee'){
                return redirect()->intended('pos');
            }elseif($role === 'customer'){
                return redirect()->intended('student-dash');
            }
        }else{
            return redirect('/')->with('failed', 'Email atau Password Salah');
        }
    }
}
