<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Cookie;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class TokenVerify
{
    public function handle($request, Closure $next) 
    {
        try {
            $request->token = session()->get('jwt-token');
            
            if (session()->get('jwt-token')) {
                $request->jwt = JWT::decode(session()->get('jwt-token'), new Key(env('JWT_SECRET'), 'HS256'));
            } else {
                return redirect('/');
            }
        } catch (\Exception $e) {
            return redirect('/');
        }

        return $next($request);
    }
}