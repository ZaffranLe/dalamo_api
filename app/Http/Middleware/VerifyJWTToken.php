<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

use Closure;

class VerifyJWTToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $token = JWTAuth::getToken();
        // $user = JWTAuth::getPayload($token);
        // if ($user) {
        //     return response(['user' => $user], Response::HTTP_OK);
        // }
        return $next($request);
    }
}
