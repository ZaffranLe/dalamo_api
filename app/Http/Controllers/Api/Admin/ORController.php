<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order_receipt;
use Illuminate\Support\Facades\DB;

class ORController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$brand = Order_receipt::all();
        $order_receipt = DB::table('order_receipt')
                ->join('user','user.id','=','order_receipt.idUser')
                ->join('order_status','order_status.id','=','order_receipt.idStatus')
                ->select('order_receipt.id','order_status.name as statusName','order_receipt.name','order_receipt.phone','order_receipt.address','order_receipt.note','user.fullname as userOrdered')
                ->get();
        return response()->json($order_receipt);
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
        $order_receipt = new Order_receipt([
        	'idStatus' => $request->get('idStatus'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'note' => $request->get('note'),
            'idUser' => $request->get('idUser'),
            'createdBy' => $request->get('createdBy'),
            'createdDate' => $request->get('createdDate'),
            'updatedBy' => $request->get('updatedBy'),
            'updatedDate' => $request->get('updatedDate'),
            'deletedBy' => $request->get('deletedBy'),
            'deletedDate' => $request->get('deletedDate'),
            'isDeleted' => $request->get('isDeleted')
        ]);
        $order_receipt->save();
        return response()->json('Add Order Receipt Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_receipt = Order_receipt::find($id);
        return response()->json($order_receipt);
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
        $order_receipt = Order_receipt::find($id);
        $order_receipt->idStatus = $request->get('idStatus');
        $order_receipt->name = $request->get('name');
        $order_receipt->phone = $request->get('phone');
        $order_receipt->address = $request->get('address');
        $order_receipt->note = $request->get('note');
        $order_receipt->idUser = $request->get('idUser');
        $order_receipt->createdBy = $request->get('createdBy');
        $order_receipt->createdDate = $request->get('createdDate');
        $order_receipt->updatedBy = $request->get('updatedBy');
        $order_receipt->updatedDate = $request->get('updatedDate');
        $order_receipt->deletedBy = $request->get('deletedBy');
        $order_receipt->deletedDate = $request->get('deletedDate');
        $order_receipt->isDeleted = $request->get('isDeleted');
        $order_receipt->save();
         return response()->json('Order Receipt Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_receipt = Order_receipt::find($id);
        $order_receipt->delete();
        return response()->json('Order Receipt Deleted Successfully');
    }
}
