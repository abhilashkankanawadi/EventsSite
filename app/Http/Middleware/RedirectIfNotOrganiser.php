<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfNotOrganiser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
         if (Auth::guard($guard)->check()) {
        return redirect('/organiser/dashboard');
    }
        return $next($request);
    }
}
