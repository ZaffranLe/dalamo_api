<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OS;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class OSController extends Controller
{
    public function index()
    {
        $order_status = DB::table('order_status')
        ->get();

        return response()->json($order_status);
    }

    public function store(Request $request)
    {
        $order_status = new OS([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'color' => $request->get('color'),
            'status' => $request->get('status'),
            'createdBy' => 1,
            'createdDate' =>time::now()
        ]);
        $order_status->save();
        return response()->json( $order_status);
    }

    public function show($id)
    {
        $order_status = DB::table('order_status')
        ->select('id','name','description')
        ->where('id','=',$id)
        ->get();
        return response()->json($order_status);
    }

    public function update(Request $request, $id)
    {
        $order_status = OS::find($id);
        $order_status->name = $request->get('name');
        $order_status->description = $request->get('description');
        $order_status->color = $request->get('color');
        $order_status->status = $request->get('status');
        $order_status->updatedBy =1;
        $order_status->updatedDate = time::now();
        $order_status->save();
         return response()->json($order_status);
    }
    public function destroy($id)
    {
        $order_status = OS::find($id);
        $order_status->delete();
        return response()->json($order_status);
    }
}
