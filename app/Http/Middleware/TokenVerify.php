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
            $request->token = $_COOKIE['token'];
            // dd($request->token);
            $request->jwt = JWT::decode($_COOKIE['token'], new Key(env('JWT_SECRET'), 'HS256'));

        } catch (\Exception $e) {
            return redirect('/');
        }

        return $next($request);
    }
}