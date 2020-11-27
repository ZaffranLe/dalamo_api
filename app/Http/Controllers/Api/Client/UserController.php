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
        $this->middleware('verify.jwt')->onlu('update');
    }

    public function index()
    {
        //$brand = Users::all();
        $user = DB::table('user')
                ->leftJoin('role','role.id','=','user.idRole')
                ->select('user.id','user.fullName','user.idRole','role.name as roleName','user.email','user.phone','user.address')
                ->where('user.status','=' ,1)
                ->get();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new Users([
            'fullName' => $request->get('fullName'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'password' => $request->get('password'),
            'idRole' => $request->get('idRole'),
            'createdBy' =>1,
            'createdDate' =>time::now(),
            'status' => $request->get('status')
        ]);
        $user->save();
        return response()->json($user);
    }

    public function show($id)
    {
        $user = DB::table('user')
        ->leftJoin('role','role.id','=','user.idRole')
        ->select('user.id','user.fullName','user.idRole','role.name as roleName','user.email','user.phone','user.address')
        ->where('user.id','=' ,$id)
        ->get();
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $currentUser = $request->user;
        if ($id != $currentUser->id) {
            return response(["error" => "Forbidden"], Response::HTTP_FORBIDDEN);
        }
        $user = Users::find($id);
        $password = $request->get('password');
        if (md5($password) != $user->password) {
            return response(["error" => "Bạn nhập sai mật khẩu! Vui lòng kiểm tra lại."], Response::HTTP_BAD_REQUEST);
        }
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

    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
        return response()->json($user);
    }
}
