<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusMiddleWare
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_active == false){
            Auth::logout();
            return redirect()->route('login.form')->with('message', 'You banned');
            }

        return $next($request);

    }
}
