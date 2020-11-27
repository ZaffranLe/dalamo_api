<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order_receipt;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class ORController extends Controller
{
    public function index()
    {
        $order_receipt = DB::table('order_receipt')
            ->leftJoin('order_status','order_status.id','=','order_receipt.idStatus')
            ->leftJoin('detail_order','detail_order.idReceipt','=','order_receipt.id')
            ->select('order_receipt.*', 'order_status.name as statusName', 'order_status.description as statusDes', 
                    'order_status.color as color', DB::raw('sum(detail_order.quantity) as total'))
            ->groupBy('order_receipt.id')
            ->get();

        return response()->json($order_receipt);
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
        return response($order_receipt, Response::HTTP_CREATED);
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
        $order_receipt->save();
        
        $detailOrder = DB::table('detail_order')->where('idReceipt', '=', $id)->select( DB::raw('sum(quantity) as total'))->first();
        $total = $detailOrder->total;
        $order_receipt->total = $total;

        return response()->json($order_receipt);
    }
    public function destroy($id)
    {
        $order_receipt = Order_receipt::find($id);
        $order_receipt->delete();
        return response()->json($order_receipt);
    }
}
