<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        // if(!Auth::check()){
        //     return redirect('login');
        // }

        $user = Auth::user();

        // if ($user->role == $roles) {
        //     return $next($request);
        // }
        
            if ($user->role == $roles) {
                return $next($request);
            }

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

        // $roles = ['1', '2', '3'];

        // $admin = [$roles[0], $roles[1]];
        // $role3 = $roles[2];

        // if (in_array($user->role, $admin)) {
        //     return redirect()-> intended('dashboard');
        //     return $next($request);
        // } elseif ($user->role === $role3) {
        //     return redirect()-> intended('home');
        //     return $next($request);
        // } 
    
        // return redirect('login')->with('error', "Belum ada akses");

        

        
        // return redirect('login')->with('error', "Belum ada akses");

    }
}
