<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class UserController extends Controller
{
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
        $user = Users::find($id);
     	$user->fullName = $request->get('fullName');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->password = $request->get('password');
        $user->idRole = $request->get('idRole');
        $user->updatedBy = 1;
        $user->updatedDate = time::now();
        $user->status = $request->get('status');
        $user->save();
         return response()->json($user);
    }
    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
        return response()->json($user);
    }
}
