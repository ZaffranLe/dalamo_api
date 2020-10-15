<?php

namespace App\Http\Controllers\Api;

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
        $brand = DB::table('detail_order')
                ->join('order_receipt','order_receipt.id','=','detail_order.idReceipt')
                ->join('product','product.id','=','detail_order.idProduct')
                ->join('user','user.id','=','order_receipt.idUser')
                ->join('order_status','order_status.id','=','order_receipt.idStatus')
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
        $brand = new Order_receipt([
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
        $brand->save();
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
        $brand = Order_receipt::find($id);
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
        $brand = Order_receipt::find($id);
        $brand->idStatus = $request->get('idStatus');
        $brand->name = $request->get('name');
        $brand->phone = $request->get('phone');
        $brand->address = $request->get('address');
        $brand->note = $request->get('note');
        $brand->idUser = $request->get('idUser');
        $brand->createdBy = $request->get('createdBy');
        $brand->createdDate = $request->get('createdDate');
        $brand->updatedBy = $request->get('updatedBy');
        $brand->updatedDate = $request->get('updatedDate');
        $brand->deletedBy = $request->get('deletedBy');
        $brand->deletedDate = $request->get('deletedDate');
        $brand->isDeleted = $request->get('isDeleted');
        $brand->save();
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
        $brand = Order_receipt::find($id);
        $brand->delete();
        return response()->json('Order Receipt Deleted Successfully');
    }
}
