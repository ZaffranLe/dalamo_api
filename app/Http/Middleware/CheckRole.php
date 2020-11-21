<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {   
        return response($role, Response::HTTP_OK);
        return $next($request);
    }
}
