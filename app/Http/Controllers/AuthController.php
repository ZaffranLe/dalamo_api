<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Carbon\Carbon as time;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $params = $request->only('email', 'fullName', 'password');
        $user = new User();
        $user->email = $params['email'];
        $user->fullName = $params['fullName'];
        $user->password = md5($params['password']);
        $user->createdBy = 0;
        $user->createdDate = time::now();
        $user->idRole = 2;
        $user->phone = "";
        $user->save();

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $email = $credentials["email"];
        $password = md5($credentials["password"]);
        $user = User::firstWhere([
            ['email', '=', $email],
            ['password', '=', $password]
        ]);

        if (!($token = JWTAuth::fromUser($user))) {
            return response()->json([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(['token' => $token], Response::HTTP_OK);
    }

    public function test() 
    {
        try {
            // $token = JWTAuth::getToken();
            // $user = JWTAuth::getPayload($token);

            // if ($user) {
            //     return response(['user' => $user], Response::HTTP_OK);
            // }
            return response(null, Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function user(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            return response(['user' => $user], Response::HTTP_OK);
        }

        return response(null, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) {
        $this->validate($request, ['token' => 'required']);
        
        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json('You have successfully logged out.', Response::HTTP_OK);
        } catch (JWTException $e) {
            return response()->json('Failed to logout, please try again.', Response::HTTP_BAD_REQUEST);
        }
    }

    public function refresh()
    {
        return response(JWTAuth::getToken(), Response::HTTP_OK);
    }
}