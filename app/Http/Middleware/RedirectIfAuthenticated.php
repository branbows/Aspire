<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //return redirect('/home');
			$user = getUserRecord();
			if( in_array($user->role_id, array( OWNER_ROLE_ID, ADMIN_ROLE_ID)) )
			{
				return redirect($this->redirectTo);
			}
			elseif( $user->role_id == USER_ROLE_ID )
			{
				return redirect( URL_USERS_DASHBOARD );
			}
			else
			{
				return redirect($this->redirectTo);
			}
        }
        return $next($request);
    }
}
