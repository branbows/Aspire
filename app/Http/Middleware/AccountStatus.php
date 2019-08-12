<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use Illuminate\Auth\AuthenticationException;
// use Illuminate\Contracts\Auth\Factory as Auth;
use Closure;
use Illuminate\Support\Facades\Auth;


class AccountStatus
{

    /**
     * The authentication factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()) {
            if (!$request->user()->login_enabled) {
                Auth::logout();
                \Session::flush();
                return redirect(URL_USERS_LOGIN);
            }
        }

        return $next($request); 
    }
}

