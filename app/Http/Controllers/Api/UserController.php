<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB;

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
                ->leftJoin('role','role.id','=','user.idUserRole')
                ->select('user.id','user.fullName','user.idUserRole','role.name as roleName','user.email','user.phone','user.address')
                ->where('user.isDeleted','=' ,0)
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
            'isUserRole' => $request->get('isUserRole'),
            'createdBy' => $request->get('createdBy'),
            'createdDate' => $request->get('createdDate'),
            'updatedBy' => $request->get('updatedBy'),
            'updatedDate' => $request->get('updatedDate'),
            'deletedBy' => $request->get('deletedBy'),
            'deletedDate' => $request->get('deletedDate'),
            'isDeleted' => $request->get('isDeleted')
        ]);
        $user->save();
        return response()->json('Add User Successfully.');
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
        ->leftJoin('role','role.id','=','user.idUserRole')
        ->select('user.id','user.fullName','user.idUserRole','role.name as roleName','user.email','user.phone','user.address')
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
        $user->isUserRole = $request->get('isUserRole');
        $user->createdBy = $request->get('createdBy');
        $user->createdDate = $request->get('createdDate');
        $user->updatedBy = $request->get('updatedBy');
        $user->updatedDate = $request->get('updatedDate');
        $user->deletedBy = $request->get('deletedBy');
        $user->deletedDate = $request->get('deletedDate');
        $user->isDeleted = $request->get('isDeleted');
        $user->save();
         return response()->json('User Update Successfully');
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
        return response()->json('User Deleted Successfully');
    }
}
