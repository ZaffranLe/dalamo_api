<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OS;
use Illuminate\Support\Facades\DB;

class OSController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_status = DB::table('order_status')
        ->select('id','name','description')
        ->where('status','=',1)
        ->get();

        return response()->json($order_status);
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
        $order_status = new OS([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'createdBy' => $request->get('createdBy'),
            'createdDate' => $request->get('createdDate'),
            'updatedBy' => $request->get('updatedBy'),
            'updatedDate' => $request->get('updatedDate'),
            'deletedBy' => $request->get('deletedBy'),
            'deletedDate' => $request->get('deletedDate'),
            'status' => $request->get('status')
        ]);
        $order_status->save();
        return response()->json('Add Order-status Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_status = DB::table('order_status')
        ->select('id','name','description')
        ->where('id','=',$id)
        ->get();
        return response()->json($order_status);
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
        $order_status = OS::find($id);
        $order_status->name = $request->get('name');
        $order_status->description = $request->get('description');
        $order_status->createdBy = $request->get('createdBy');
        $order_status->createdDate = $request->get('createdDate');
        $order_status->updatedBy = $request->get('updatedBy');
        $order_status->updatedDate = $request->get('updatedDate');
        $order_status->deletedBy = $request->get('deletedBy');
        $order_status->deletedDate = $request->get('deletedDate');
        $order_status->status = $request->get('status');
        $order_status->save();
         return response()->json('Order-status Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_status = OS::find($id);
        $order_status->delete();
        return response()->json('Order-status Deleted Successfully');
    }
}
