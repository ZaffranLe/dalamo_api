<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        try {
            $token = JWTAuth::getToken();
            $user = JWTAuth::getPayload($token);
            if ($user) {
                $userExist = DB::table('user')
            ->leftJoin('role', 'role.id', '=', 'user.idRole')
            ->select('user.id', 'user.fullName', 'role.name as role', 'user.email', 'user.phone', 'user.address')
            ->where('user.id', '=', $user["sub"])
            ->get()->first();
                if ($userExist) {
                    $request->user = $userExist;
                    return $next($request);
                } else {
                    return response(['error' => 'User not found'], Response::HTTP_UNAUTHORIZED);
                }
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response(['error' => 'Token has expired', 'code' => 'TOKEN_EXPIRED'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response(['error' => $e->getMessage(), 'code' => 'JWT_EXCEPTION'], Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return response(['error' => $e->getMessage(), 'code' => 'EXCEPTION'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
