<?php

namespace App\Http\Middleware;

use App\Models\NavigationAdmin;
use Auth;
use Closure;

class ValidateRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @param                           $selectedNavigationId
     * @return mixed
     * @internal param null $guard
     */
    public function handle($request, Closure $next, $selectedNavigationId)
    {
        $selectedNavigation = NavigationAdmin::findOrFail($selectedNavigationId);

        // check if user role is in navigation role
        $userRoles = user()->getRolesList();
        $navValid = $selectedNavigation->roles()->whereIn('roles.id', $userRoles)->first();

        if (!$navValid) {
            return redirect(user()->roles()->first()->slug);
        }

        return $next($request);
    }
}
