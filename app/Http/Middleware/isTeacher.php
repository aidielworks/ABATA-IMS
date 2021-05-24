<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isTeacher
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
        if ($request->session()->get('userType') == 'teacher') {
            return $next($request);
        }

        return abort(403, 'Unauthorized action.');
    }
}
