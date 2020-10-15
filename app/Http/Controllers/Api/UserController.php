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
        $brand = DB::table('user')
                ->join('role','role.id','=','user.idUserRole')
                ->join('user_permission','user_permission.idUser','=','user.id')
                ->get();
        return response()->json($brand);
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
        $brand = new Users([
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
        $brand->save();
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
        $brand = Users::find($id);
        return response()->json($brand);
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
        $brand = Users::find($id);
     	$brand->fullName = $request->get('fullName');
        $brand->email = $request->get('email');
        $brand->phone = $request->get('phone');
        $brand->address = $request->get('address');
        $brand->password = $request->get('password');
        $brand->isUserRole = $request->get('isUserRole');
        $brand->createdBy = $request->get('createdBy');
        $brand->createdDate = $request->get('createdDate');
        $brand->updatedBy = $request->get('updatedBy');
        $brand->updatedDate = $request->get('updatedDate');
        $brand->deletedBy = $request->get('deletedBy');
        $brand->deletedDate = $request->get('deletedDate');
        $brand->isDeleted = $request->get('isDeleted');
        $brand->save();
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
        $brand = Users::find($id);
        $brand->delete();
        return response()->json('User Deleted Successfully');
    }
}
