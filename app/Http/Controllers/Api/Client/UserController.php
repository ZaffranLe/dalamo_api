<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = DB::table('user')
        ->leftJoin('role','role.id','=','user.idRole')
        ->select('user.id','user.fullName','user.idRole','role.name as roleName','user.email','user.phone','user.address')
        ->where('user.id','=' ,$id)
        ->get();
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
        return response()->json($user);
    }
}
