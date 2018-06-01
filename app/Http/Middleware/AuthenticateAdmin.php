<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param null                      $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // not logged in as an admin - logout and go home
        if (!user()->isAdmin()) {
            \Auth::logout();

            return redirect()->guest('/');
        }

        return $next($request);
    }
}
