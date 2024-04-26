<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong',
        ]
    );

    $credential = $request->only('username', 'password');
    if (Auth::attempt($credential)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === '1' || $user->role === '2') {
            return redirect()->intended('dashboard');
        } elseif ($user->role === '3') {
            return redirect()-> intended('home');
        } 

        // switch ($user->role) {
        //     case '1':
        //     case '2':
        //         return redirect()->intended('dashboard');
        //         break;
        //     case '3':
        //         return redirect()->intended('home');
        //         break;
        //     default:
        //         return redirect()->intended('login')->with('error', 'Peran pengguna tidak valid.');
        //         break;
        // }

    }

        return back()->withErrors([
            'username' => 'Maaf username atau password salah',
        ])->onlyInput('username');;
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
