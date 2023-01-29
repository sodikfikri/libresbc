<?php

namespace App\Http\Middleware;
use Closure;
use Exception;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }

    public function handle($request, Closure $next) 
    {
        try {
            dd($_COOKIE);
        } catch (\Exception $e) {
            dd($e);
            return redirect('/');
        }

        return $next($request);
    }
    
}
