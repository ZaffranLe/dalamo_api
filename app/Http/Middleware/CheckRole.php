<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RoleEnum;

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
        $user = $request->user;
        if ($user->role == $role) {
            return $next($request);
        }
        return response(['error' => 'Forbidden access', 'code' => 'FORBIDDEN_ACCESS'], Response::HTTP_FORBIDDEN);
    }
}
