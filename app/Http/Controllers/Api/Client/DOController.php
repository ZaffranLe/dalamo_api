<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Detail_order;

class DOController extends Controller
{
    public function index()
    {
        $detail_order = Detail_order::all();
        return response()->json($detail_order);
    }

    public function store(Request $request)
    {
        $detail_order = new Detail_order([
            'idReceipt' => $request->get('idReceipt'),
            'idProduct' => $request->get('idProduct'),
            'quantity' => $request->get('quantity')
        ]);
        $detail_order->save();
        return response()->json($detail_order);
    }

    public function show($id)
    {
        $detail_order = Detail_order::find($id);
        return response()->json($detail_order);
    }

    public function update(Request $request, $id)
    {
        $detail_order = Detail_order::find($id);
        $detail_order->idReceipt = $request->get('idReceipt');
        $detail_order->idProduct = $request->get('idProduct');
        $detail_order->quantity = $request->get('quantity');
        $detail_order->save();
         return response()->json($detail_order);
    }
    public function destroy($id)
    {
        $detail_order = Detail_order::find($id);
        $detail_order->delete();
        return response()->json($detail_order);
    }
}
