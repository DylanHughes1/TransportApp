<?php

namespace App\Http\Middleware;

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
        if(! $request->expectsJson() && $request->is('administrator*')) {
            return route('administrator.login');
        }
        if(! $request->expectsJson() && $request->is('admin*')) {
            return route('admin.login');
        }
        if(! $request->expectsJson() && $request->is('truck_driver*')) {
            return route('truck_driver.login');
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
