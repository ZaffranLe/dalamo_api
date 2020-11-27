<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order_receipt;
use App\Models\Detail_order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class ORController extends Controller
{
    public function __construct()
    {
        $this->middleware('verify.jwt')->except('store');
    }

    public function index(Request $request)
    {
        $user = $request->user;
        
        $order_receipt = DB::table('order_receipt')
                ->leftJoin('order_status', 'order_status.id', '=', 'order_receipt.idStatus')
                ->select(
                    'order_receipt.id',
                    'order_receipt.totalPrice',
                    'order_status.name as statusName',
                    'order_status.description as statusDescription',
                    'order_status.color as statusColor',
                    'order_receipt.name',
                    'order_receipt.phone',
                    'order_receipt.address',
                    'order_receipt.note',
                    'order_receipt.createdDate'
                )
                ->where('order_receipt.idUser', '=', $user->id)
                ->get();
        return response()->json($order_receipt);
    }

    public function store(Request $request)
    {
        $order_receipt = new Order_receipt([
            'idStatus' => 1,
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'note' => $request->get('note'),
            'idUser' => $request->get('idUser'),
            'createdBy' => 0,
            'createdDate' =>  time::now(),
            'totalPrice' => $request->get('totalPrice')
        ]);
        $order_receipt->save();
        
        $detail_order = $request->get('products');
        
        foreach ($detail_order as $val) {
            $do_obj = new Detail_order([
                'idReceipt' => $order_receipt->id,
                'quantity' => $val["quantity"],
                'price' => $val["price"],
                'idProduct' => $val["idProduct"],
            ]);
            $do_obj->save();
        }

        $order_receipt->products = $detail_order;

        return response()->json($order_receipt);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user;
        $order_receipt = DB::table('order_receipt')
                ->leftJoin('order_status', 'order_status.id', '=', 'order_receipt.idStatus')
                ->select(
                    'order_receipt.id',
                    'order_receipt.totalPrice',
                    'order_status.name as statusName',
                    'order_status.description as statusDescription',
                    'order_status.color as statusColor',
                    'order_receipt.name',
                    'order_receipt.phone',
                    'order_receipt.address',
                    'order_receipt.note',
                    'order_receipt.createdDate',
                    'order_receipt.idUser'
                )
                ->where('order_receipt.id', '=', $id)
                ->get()->first();
        if ($order_receipt->idUser == $user->id) {
            $detail_orders = DB::table('detail_order as do')
                ->leftJoin('product as p', 'do.idProduct', '=', 'p.id')
                ->select(
                    'p.id',
                    'p.name',
                    'do.quantity',
                    'do.price'
                )
                ->where('do.idReceipt', '=', $order_receipt->id)->get();
            foreach($detail_orders as $val) {
                $image = DB::table('image')->select('url')->where('idProduct', '=', $val->id)->get()->first();
                $val->imgUrl = $image->url;
            }
            $order_receipt->detail = $detail_orders;
            return response()->json($order_receipt);
        } else {
            return response(["error" => "Forbidden"], Response::HTTP_FORBIDDEN);
        }
    }

}
