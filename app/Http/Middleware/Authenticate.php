<?php

namespace App\Http\Middleware;
use Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //if admin not auth and try to visit admin/* return to login for admin else return to user login
            if(Request::is('admin*'))
                return route('admin.login');
            else
                return route('login');
        }
    }
}
