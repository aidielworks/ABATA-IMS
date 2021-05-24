<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isStudent
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
        if ($request->session()->get('userType') == 'student') {
            return $next($request);
        }

        return abort(403, 'Unauthorized action.');
    }
}
