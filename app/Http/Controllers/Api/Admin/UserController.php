<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('user')
                ->get();
        foreach($users as $user)
            unset($user->password);
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = new User([
            'fullName' => $request->get('fullName'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'password' => md5($request->get('password')),
            'idRole' => $request->get('idRole'),
            'createdBy' => 1,
            'createdDate' =>time::now(),
            'status' => $request->get('status')
        ]);
        $user->save();
        return response($user, Response::HTTP_CREATED);
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
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $user = User::find($id);
        // $out->writeln($request->password ? 1 : 2);
     	$user->fullName = $request->get('fullName');
        $user->email = $request->get('email');
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->password = md5($request->get('password')) ?? $user->password;
        $user->idRole = $request->get('idRole');
        $user->updatedBy = 1;
        $user->updatedDate = time::now();
        $user->status = $request->get('status');
        $user->save();
         return response()->json($user);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }
}
