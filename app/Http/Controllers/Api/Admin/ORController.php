<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order_receipt;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class ORController extends Controller
{
    public function index()
    {
        //$brand = Order_receipt::all();
        $order_receipt = DB::table('order_receipt')
                ->leftJoin('order_status','order_status.id','=','order_receipt.idStatus')
                ->leftJoin('detail_order','detail_order.idReceipt','=','order_receipt.id')
                ->leftJoin('product','product.id','=','detail_order.idProduct')
                ->select('order_receipt.id','order_receipt.totalPrice','order_status.name as statusName',
                'order_receipt.name','order_receipt.phone','order_receipt.address','order_receipt.note',
                'product.id as idProduct','product.name as nameProduct','detail_order.quantity as priceTotal')
                ->get();
                $order_receiptList=[];
                foreach($order_receipt as $val){
                    if(isset($order_receiptList[$val->id])){
                        // Tồn tại
                        $order_receiptList[$val->id]['product'][]=[
                            'idProduct'=>$val->idProduct,
                            'nameProduct'=>$val->nameProduct
                        ];

                    }
                    else{
                        $item=[
                            'id'=>$val->id,
                            'totalPrice'=>$val->totalPrice,
                            'statusName'=>$val->statusName,
                            'name'=>$val->name,
                            'phone'=>$val->phone,
                            'address'=>$val->address,
                            'note'=>$val->note,
                            'priceTotal'=>$val->priceTotal,
                            'product'=>[
                                'idProduct'=>$val->idProduct,
                                'nameProduct'=>$val->nameProduct
                            ]
                            ];
                            $order_receiptList[$val->id]=$item;
                    }
                }
        return response()->json($order_receiptList);
    }

    public function store(Request $request)
    {
        $order_receipt = new Order_receipt([
        	'idStatus' => $request->get('idStatus'),
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'note' => $request->get('note'),
            'idUser' => $request->get('idUser'),
            'createdBy' => 1,
            'createdDate' =>  time::now(),
            'idStatus' => $request->get('idStatus'),
            'totalPrice' => $request->get('totalPrice')
        ]);
        $order_receipt->save();
        return response()->json($order_receipt);
    }

    public function show($id)
    {
        $order_receipt = Order_receipt::find($id);
        return response()->json($order_receipt);
    }

    public function update(Request $request, $id)
    {
        $order_receipt = Order_receipt::find($id);
        $order_receipt->idStatus = $request->get('idStatus');
        $order_receipt->name = $request->get('name');
        $order_receipt->phone = $request->get('phone');
        $order_receipt->address = $request->get('address');
        $order_receipt->note = $request->get('note');
        $order_receipt->idUser = $request->get('idUser');
        $order_receipt->updatedBy = 1;
        $order_receipt->updatedDate = time::now();
        $order_receipt->idStatus = $request->get('idStatus');
        $order_receipt->totalPrice = $request->get('totalPrice');
        $order_receipt->save();
         return response()->json($order_receipt);
    }
    public function destroy($id)
    {
        $order_receipt = Order_receipt::find($id);
        $order_receipt->delete();
        return response()->json($order_receipt);
    }
}
