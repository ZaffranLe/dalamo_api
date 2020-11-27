<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('verify.jwt')->only('update');
    }

    public function update(Request $request, $id)
    {
        $currentUser = $request->user;
        if ($id != $currentUser->id) {
            return response(["error" => "Forbidden"], Response::HTTP_FORBIDDEN);
        }
        $user = User::find($id);
     	$user->fullName = $request->get('fullName');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        
        $newPassword = $request->get('newPassword');
        if ($newPassword) {
            $user->password = md5($newPassword);
        }
        $user->updatedDate = time::now();
        $user->save();
        return response(Response::HTTP_OK);
    }

}
