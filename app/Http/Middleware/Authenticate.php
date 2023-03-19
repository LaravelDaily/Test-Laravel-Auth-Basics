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
    protected function redirectTo($request, Closure $next)
    {
        if (! Auth::check()){
          if (! $request->expectsJson()) {
            return route('login');
            }   
        }
        return $next($request);
        
    }
}
