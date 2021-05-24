<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('userType')) {
            if ($request->session()->get('userType') == 'employee') {
                return redirect('/home');
            } elseif ($request->session()->get('userType') == 'teacher') {
                return redirect('/teachers');
            } elseif ($request->session()->get('userType') == 'student') {
                return redirect('/students');
            }
        } else {
            return $next($request);
        }
    }
}
